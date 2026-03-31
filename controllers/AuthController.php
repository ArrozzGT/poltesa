<?php
// File: controllers/AuthController.php

// --- PERBAIKAN: Load Model Terlebih Dahulu ---
// Menggunakan __DIR__ agar path tetap benar meskipun dipanggil dari folder lain
require_once __DIR__ . '/../models/AnggotaModel.php';
require_once __DIR__ . '/../models/AdminModel.php';

class AuthController {
    private $anggotaModel;
    private $adminModel;

    public function __construct() {
        // Sekarang class Model sudah dikenali karena sudah di-require di atas
        $this->anggotaModel = new AnggotaModel();
        $this->adminModel = new AdminModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isAjax     = isset($_POST['ajax']) && $_POST['ajax'] == 1;
            $identifier = trim($_POST['identifier'] ?? ''); 
            $password   = $_POST['password'] ?? '';

            // 1. Cek Login Admin
            $admin = $this->adminModel->login($identifier, $password);
            if ($admin) {
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['admin_id']     = $admin['admin_id'];
                $_SESSION['nama_lengkap'] = $admin['nama_lengkap'];
                $_SESSION['role']         = 'admin';
                $_SESSION['admin_level']  = $admin['level'];
                $_SESSION['admin_org_id'] = $admin['organisasi_id'] ?? null;
                
                Database::catatAktivitas($admin['admin_id'], $admin['level'], 'Login ke Sistem');
                
                $redirectUrl = ($admin['level'] == 'super_admin') ? 'index.php?action=admin_dashboard' : 'index.php?action=ormawa_dashboard';
                
                if ($isAjax) {
                    echo json_encode(['status' => 'success', 'redirect' => $redirectUrl]);
                    exit;
                }
                header('Location: ' . $redirectUrl); exit;
            }

            // 2. Cek Login Anggota
            $anggota = $this->anggotaModel->login($identifier, $password);
            if ($anggota) {
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['anggota_id']   = $anggota['anggota_id'];
                $_SESSION['nama_lengkap'] = $anggota['nama_lengkap'];
                $_SESSION['role']         = 'anggota';
                
                Database::catatAktivitas($anggota['anggota_id'], 'anggota', 'Login ke Sistem');
                
                if ($isAjax) {
                    echo json_encode(['status' => 'success', 'redirect' => 'index.php?action=dashboard']);
                    exit;
                }
                header('Location: index.php?action=dashboard'); exit;
            }

            // Gagal
            $error = "NIM/Email atau Password salah!";
            if ($isAjax) {
                echo json_encode(['status' => 'error', 'message' => $error]);
                exit;
            }
            require 'views/auth/login.php';
        } else {
            require 'views/auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isAjax = isset($_POST['ajax']) && $_POST['ajax'] == 1;
            
            $data = [
                'nim' => trim($_POST['nim'] ?? ''),
                'nama_lengkap' => trim($_POST['nama_lengkap'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'jurusan' => $_POST['jurusan'] ?? '',
                'fakultas' => ($_POST['jurusan'] == 'Agrobisnis' || $_POST['jurusan'] == 'Agroindustri') ? 'Pertanian' : (($_POST['jurusan'] == 'Manajemen Bisnis Pariwisata') ? 'Bisnis' : 'Teknik dan Informatika'), 
                'angkatan' => $_POST['angkatan'] ?? '',
                'no_telepon' => $_POST['no_telepon'] ?? '',
                'foto_profil' => null
            ];

            // Validasi Input Utama
            if (empty($data['nim']) || empty($data['email']) || empty($data['password'])) {
                if($isAjax) { echo json_encode(['status'=>'error', 'message'=>'Ada bidang penting yang belum diisi.']); exit; }
                $_SESSION['error'] = "Data belum lengkap!";
                require 'views/auth/register.php'; return;
            }

            if ($this->anggotaModel->cekNimExist($data['nim'])) {
                if($isAjax) { echo json_encode(['status'=>'error', 'message'=>'NIM tersebut sudah terdaftar!']); exit; }
                $_SESSION['error'] = "NIM sudah terdaftar!";
            } else if ($this->anggotaModel->cekEmailExist($data['email'])) {
                if($isAjax) { echo json_encode(['status'=>'error', 'message'=>'Alamat Email tersebut sudah terdaftar!']); exit; }
                $_SESSION['error'] = "Email sudah terdaftar!";
            } else {
                
                // --- PENANGANAN FOTO PROFIL (Base64 dari Cropper/Javascript) ---
                if (!empty($_POST['foto_base64'])) {
                    $targetDir = "assets/images/profil/";
                    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                    
                    $image_parts = explode(";base64,", $_POST['foto_base64']);
                    if (count($image_parts) >= 2) {
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1] ?? 'jpg';
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $fileName = 'anggota_' . time() . '_' . uniqid() . '.' . $image_type;
                        if (file_put_contents($targetDir . $fileName, $image_base64)) {
                            $data['foto_profil'] = $fileName;
                        }
                    }
                }

                if ($this->anggotaModel->register($data)) {
                    if($isAjax) { echo json_encode(['status'=>'success', 'redirect'=>'index.php?action=login&status=registered']); exit; }
                    $success = "Pendaftaran berhasil! Silakan login.";
                    require 'views/auth/login.php';
                    return; 
                } else {
                    if($isAjax) { echo json_encode(['status'=>'error', 'message'=>'Terjadi kesalahan sistem, gagal mendaftar.']); exit; }
                    $_SESSION['error'] = "Gagal mendaftar. Coba lagi.";
                }
            }
            require 'views/auth/register.php';
        } else {
            require 'views/auth/register.php';
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>