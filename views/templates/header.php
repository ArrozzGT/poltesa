<?php
// Mendapatkan path dasar secara otomatis
$path = dirname($_SERVER['SCRIPT_NAME']);
$base_path = rtrim($path, '/') . '/';

// Logika untuk menentukan halaman aktif
$current_page = $_GET['action'] ?? 'beranda';

// Cek session start (Hanya start jika belum aktif)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Dynamic page title
$page_titles = [
    'beranda'                => 'Beranda',
    'index'                  => 'Beranda',
    'organisasi'             => 'Daftar Organisasi',
    'detail'                 => 'Detail Organisasi',
    'login'                  => 'Masuk',
    'register'               => 'Daftar Akun',
    'dashboard'              => 'Dashboard',
    'profile'                => 'Profil Saya',
    'riwayat'                => 'Riwayat Pendaftaran',
    'admin_dashboard'        => 'Dashboard Super Admin',
    'ormawa_dashboard'       => 'Dashboard Admin Ormawa',
    'admin_kelola_organisasi'=> 'Kelola Organisasi',
    'admin_kelola_pengguna'  => 'Kelola Pengguna',
    'ormawa_kelola_anggota'  => 'Data Anggota',
    'ormawa_kelola_divisi'   => 'Kelola Divisi',
    'ormawa_seleksi'         => 'Seleksi Masuk',
    'ormawa_kegiatan'        => 'Galeri Kegiatan',
    'ormawa_laporan'         => 'Laporan Kinerja',
    'ormawa_progja'          => 'Program Kerja',
];
$page_title  = $page_titles[$current_page] ?? 'ORMAWA';
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORMAWA POLTESA | <?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="Sistem Informasi Organisasi Mahasiswa Politeknik Negeri Sambas — Satu pintu untuk mendaftar dan berkembang bersama organisasi mahasiswa terbaik.">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- SINORA Global CSS -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css?v=<?php echo time(); ?>">

    <!-- Theme preference: apply immediately to prevent flash -->
    <script>
        (function () {
            var t = localStorage.getItem('sinora_theme') ||
                    (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="<?php echo $base_path; ?>index.php">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                <span class="brand-name">ORMAWA</span>
                <span class="brand-sub">Politeknik Negeri Sambas</span>
            </div>
        </a>

        <!-- Mobile toggler -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav links -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['beranda','index']) ? 'active' : ''; ?>"
                       href="<?php echo $base_path; ?>index.php">
                        <i class="fas fa-home me-1 d-lg-none"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['organisasi','detail']) ? 'active' : ''; ?>"
                       href="<?php echo $base_path; ?>index.php?action=organisasi">
                        <i class="fas fa-university me-1 d-lg-none"></i>Organisasi
                    </a>
                </li>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'anggota'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>"
                       href="<?php echo $base_path; ?>index.php?action=dashboard">
                        <i class="fas fa-tachometer-alt me-1 d-lg-none"></i>Dashboard
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Right side -->
            <div class="d-flex align-items-center gap-2">

                <!-- Dark mode toggle -->
                <button id="darkModeToggle" class="btn-dark-mode" title="Mode Gelap" type="button">
                    <i id="darkModeIcon" class="fas fa-moon"></i>
                </button>

                <?php if (isset($_SESSION['admin_id'])):
                    $dashboard_link = 'index.php?action=admin_dashboard';
                    $label_admin    = 'Administrator';
                    $icon_admin     = 'fa-user-astronaut';

                    if (isset($_SESSION['admin_level']) && $_SESSION['admin_level'] == 'admin_ormawa') {
                        $dashboard_link = 'index.php?action=ormawa_dashboard';
                        $label_admin    = 'Admin Ormawa';
                        $icon_admin     = 'fa-user-shield';
                    }
                ?>
                    <div class="dropdown">
                        <a class="btn btn-nav-register d-flex align-items-center gap-2 px-3 py-2"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas <?php echo $icon_admin; ?> text-primary"></i>
                            <span class="fw-600"><?php echo $label_admin; ?></span>
                            <i class="fas fa-chevron-down small opacity-60"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li>
                                <a class="dropdown-item" href="<?php echo $dashboard_link; ?>">
                                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="index.php?action=logout"
                                   onclick="return confirm('Yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php elseif (isset($_SESSION['anggota_id'])):
                    $nama_display = isset($_SESSION['nama_lengkap'])
                        ? explode(' ', trim($_SESSION['nama_lengkap']))[0]
                        : 'Member';
                ?>
                    <div class="dropdown">
                        <a class="btn btn-nav-register d-flex align-items-center gap-2 px-3 py-2"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div style="width:28px;height:28px;background:var(--gradient-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:700;flex-shrink:0;">
                                <?php echo strtoupper(substr($nama_display, 0, 1)); ?>
                            </div>
                            <span class="d-none d-md-inline"><?php echo htmlspecialchars($nama_display); ?></span>
                            <i class="fas fa-chevron-down small opacity-60"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2" style="min-width:220px;">
                            <li class="px-3 py-2 border-bottom" style="border-color:var(--border-color)!important;">
                                <div class="small fw-700" style="color:var(--text-primary);">
                                    <?php echo htmlspecialchars($_SESSION['nama_lengkap'] ?? $nama_display); ?>
                                </div>
                                <div class="small" style="color:var(--text-muted);">Mahasiswa Aktif</div>
                            </li>
                            <li class="py-1">
                                <a class="dropdown-item" href="index.php?action=dashboard">
                                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="index.php?action=profile">
                                    <i class="fas fa-user-circle me-2 text-info"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="index.php?action=riwayat">
                                    <i class="fas fa-history me-2 text-warning"></i>Riwayat Pendaftaran
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="index.php?action=logout"
                                   onclick="return confirm('Keluar dari akun?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php else: ?>
                    <a class="btn-nav-login px-3 py-2 text-decoration-none fw-500"
                       href="<?php echo $base_path; ?>index.php?action=login">
                        <i class="fas fa-sign-in-alt me-1"></i>Masuk
                    </a>
                    <a class="btn btn-nav-register px-3 py-2"
                       href="<?php echo $base_path; ?>index.php?action=register">
                        Daftar
                    </a>
                <?php endif; ?>

            </div><!-- /right side -->
        </div><!-- /collapse -->
    </div><!-- /container -->
</nav>

<!-- PHP session alert bridge (dibaca oleh JS untuk jadi toast) -->
<?php if (isset($_SESSION['flash_message'])): ?>
<div id="php-session-alert"
     data-message="<?php echo htmlspecialchars($_SESSION['flash_message']); ?>"
     data-type="<?php echo htmlspecialchars($_SESSION['flash_type'] ?? 'info'); ?>"
     style="display:none;">
</div>
<?php
    unset($_SESSION['flash_message'], $_SESSION['flash_type']);
endif;
?>

<main style="min-height: 80vh;">