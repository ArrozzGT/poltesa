<div class="col-md-3">

<?php
$current_action = $_GET['action'] ?? '';

// ================================================================
// 1. SIDEBAR — SUPER ADMIN
// ================================================================
if (isset($_SESSION['admin_level']) && $_SESSION['admin_level'] == 'super_admin'):
?>
    <div class="card border-0 shadow-sm sticky-top" style="top:90px;z-index:100;border-radius:var(--radius-lg)!important;overflow:hidden;">

        <!-- Header -->
        <div class="d-flex align-items-center gap-3 p-3"
             style="background:var(--gradient-primary);">
            <div style="width:40px;height:40px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0;">
                <i class="fas fa-user-astronaut"></i>
            </div>
            <div>
                <div style="font-weight:700;color:#fff;font-size:0.95rem;line-height:1.1;">Super Admin</div>
                <div style="font-size:0.7rem;color:rgba(255,255,255,0.7);">Akses Penuh Sistem</div>
            </div>
        </div>

        <!-- Menu -->
        <div class="card-body p-2">

            <a href="index.php?action=admin_dashboard"
               class="nav-link-custom <?php echo ($current_action=='admin_dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt" style="color:var(--primary);"></i>
                Dashboard Pusat
            </a>

            <div class="sidebar-heading">Kelola Master</div>

            <a href="index.php?action=admin_kelola_organisasi"
               class="nav-link-custom <?php echo ($current_action=='admin_kelola_organisasi') ? 'active' : ''; ?>">
                <i class="fas fa-university" style="color:var(--accent-green);"></i>
                Data Ormawa
            </a>

            <a href="index.php?action=admin_kelola_pengguna"
               class="nav-link-custom <?php echo ($current_action=='admin_kelola_pengguna') ? 'active' : ''; ?>">
                <i class="fas fa-users-cog" style="color:var(--info);"></i>
                Manajemen User
            </a>

            <a href="index.php?action=admin_log_aktivitas"
               class="nav-link-custom <?php echo ($current_action=='admin_log_aktivitas') ? 'active' : ''; ?>">
                <i class="fas fa-history" style="color:var(--warning);"></i>
                Log Sistem
            </a>

            <div class="p-2 pt-3">
                <a href="index.php?action=logout"
                   class="btn btn-outline-danger w-100 btn-sm rounded-pill fw-600"
                   onclick="return confirm('Logout dari Super Admin?')">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>

        </div>
    </div>

<?php
// ================================================================
// 2. SIDEBAR — ADMIN ORMAWA
// ================================================================
elseif (isset($_SESSION['admin_level']) && $_SESSION['admin_level'] == 'admin_ormawa'):
?>
    <div class="card border-0 shadow-sm sticky-top" style="top:90px;z-index:100;border-radius:var(--radius-lg)!important;overflow:hidden;">

        <!-- Header -->
        <div class="d-flex align-items-center gap-3 p-3"
             style="background:linear-gradient(135deg,#2563eb,#7c3aed);">
            <div style="width:40px;height:40px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0;">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <div style="font-weight:700;color:#fff;font-size:0.95rem;line-height:1.1;">Admin Ormawa</div>
                <div style="font-size:0.7rem;color:rgba(255,255,255,0.7);">Kelola Organisasi</div>
            </div>
        </div>

        <!-- Menu -->
        <div class="card-body p-2">

            <a href="index.php?action=ormawa_dashboard"
               class="nav-link-custom <?php echo ($current_action=='ormawa_dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt" style="color:var(--primary);"></i>
                Dashboard
            </a>

            <div class="sidebar-heading">Manajemen Internal</div>

            <a href="index.php?action=ormawa_profil_lengkap"
               class="nav-link-custom <?php echo ($current_action=='ormawa_profil_lengkap') ? 'active' : ''; ?>">
                <i class="fas fa-id-card" style="color:var(--info);"></i>
                Identitas
            </a>

            <a href="index.php?action=ormawa_kelola_anggota"
               class="nav-link-custom <?php echo ($current_action=='ormawa_kelola_anggota') ? 'active' : ''; ?>">
                <i class="fas fa-users" style="color:var(--accent-green);"></i>
                Data Anggota
            </a>

            <a href="index.php?action=ormawa_seleksi"
               class="nav-link-custom <?php echo ($current_action=='ormawa_seleksi') ? 'active' : ''; ?>">
                <i class="fas fa-user-plus" style="color:var(--warning);"></i>
                Seleksi Masuk
            </a>

            <a href="index.php?action=ormawa_kelola_divisi"
               class="nav-link-custom <?php echo ($current_action=='ormawa_kelola_divisi') ? 'active' : ''; ?>">
                <i class="fas fa-sitemap" style="color:var(--secondary);"></i>
                Kelola Divisi
            </a>

            <a href="index.php?action=ormawa_progja"
               class="nav-link-custom <?php echo ($current_action=='ormawa_progja') ? 'active' : ''; ?>">
                <i class="fas fa-list-check" style="color:#6f42c1;"></i>
                Program Kerja
            </a>

            <div class="sidebar-heading">Laporan & Publikasi</div>

            <a href="index.php?action=ormawa_kegiatan"
               class="nav-link-custom <?php echo ($current_action=='ormawa_kegiatan') ? 'active' : ''; ?>">
                <i class="fas fa-camera" style="color:var(--danger);"></i>
                Galeri Kegiatan
            </a>

            <a href="index.php?action=ormawa_laporan"
               class="nav-link-custom <?php echo ($current_action=='ormawa_laporan') ? 'active' : ''; ?>">
                <i class="fas fa-file-alt" style="color:var(--primary);"></i>
                Laporan Kinerja
            </a>

            <a href="index.php?action=ormawa_pesan"
               class="nav-link-custom <?php echo ($current_action=='ormawa_pesan') ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn" style="color:var(--warning);"></i>
                Broadcast
            </a>

            <div class="p-2 pt-3">
                <a href="index.php?action=logout"
                   class="btn btn-outline-danger w-100 btn-sm rounded-pill fw-600"
                   onclick="return confirm('Logout dari Admin Ormawa?')">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>

        </div>
    </div>

<?php
// ================================================================
// 3. SIDEBAR — ANGGOTA / MAHASISWA
// ================================================================
elseif (isset($_SESSION['anggota_id'])):
    $nama_mhs  = $anggota['nama_lengkap'] ?? $_SESSION['nama_lengkap'] ?? 'Mahasiswa';
    $nim_mhs   = $anggota['nim']          ?? $_SESSION['nim']          ?? '-';
    $foto_path = $anggota['foto_profil']  ?? null;
    $foto      = ($foto_path && !empty($foto_path)) ? 'assets/images/profil/' . $foto_path : null;
    $foto_ok   = $foto && file_exists($foto);
    $inisial   = strtoupper(substr($nama_mhs, 0, 1));
?>
    <div class="card border-0 shadow-sm sticky-top" style="top:90px;border-radius:var(--radius-lg)!important;overflow:hidden;">

        <!-- Profile Header -->
        <div class="text-center p-4 pb-3" style="background:var(--gradient-primary);">
            <?php if ($foto_ok): ?>
                <img src="<?php echo htmlspecialchars($foto); ?>"
                     alt="Foto Profil"
                     class="rounded-circle border border-3 border-white shadow-sm mb-2"
                     style="width:72px;height:72px;object-fit:cover;">
            <?php else: ?>
                <div class="rounded-circle border border-3 border-white d-flex align-items-center justify-content-center mx-auto mb-2 fw-bold"
                     style="width:72px;height:72px;background:rgba(255,255,255,0.2);color:#fff;font-size:1.6rem;">
                    <?php echo $inisial; ?>
                </div>
            <?php endif; ?>
            <div style="font-weight:700;color:#fff;font-size:0.95rem;line-height:1.2;" class="mb-1">
                <?php echo htmlspecialchars($nama_mhs); ?>
            </div>
            <div style="font-size:0.72rem;color:rgba(255,255,255,0.75);background:rgba(255,255,255,0.15);padding:2px 10px;border-radius:999px;display:inline-block;">
                <?php echo htmlspecialchars($nim_mhs); ?>
            </div>
        </div>

        <!-- Edit profil btn -->
        <div class="px-3 py-2 border-bottom" style="border-color:var(--border-color)!important;">
            <a href="index.php?action=profile"
               class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-600">
                <i class="fas fa-edit me-1"></i>Edit Profil
            </a>
        </div>

        <!-- Menu -->
        <div class="p-2">
            <a href="index.php?action=dashboard"
               class="nav-link-custom <?php echo ($current_action=='dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt" style="color:var(--primary);"></i>
                Dashboard
            </a>
            <a href="index.php?action=riwayat"
               class="nav-link-custom <?php echo ($current_action=='riwayat') ? 'active' : ''; ?>">
                <i class="fas fa-history" style="color:var(--info);"></i>
                Riwayat Pendaftaran
            </a>
            <a href="index.php?action=organisasi"
               class="nav-link-custom <?php echo ($current_action=='organisasi') ? 'active' : ''; ?>">
                <i class="fas fa-search" style="color:var(--accent-green);"></i>
                Cari Organisasi
            </a>
        </div>

        <!-- Logout -->
        <div class="px-3 pb-3">
            <a href="index.php?action=logout"
               class="btn btn-danger btn-sm w-100 rounded-pill fw-600"
               onclick="return confirm('Keluar dari akun?')">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>

    </div>

<?php
// ================================================================
// 4. SIDEBAR — TAMU (Belum Login)
// ================================================================
else:
?>
    <div class="card border-0 shadow-sm" style="border-radius:var(--radius-lg)!important;overflow:hidden;">

        <!-- Icon top -->
        <div class="text-center pt-4 pb-2">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                 style="width:64px;height:64px;background:var(--primary-xlight);">
                <i class="fas fa-lock fa-xl" style="color:var(--primary);"></i>
            </div>
        </div>

        <div class="card-body pt-0 text-center px-4 pb-4">
            <h6 class="fw-700 mb-1" style="color:var(--text-primary);">Akses Terbatas</h6>
            <p class="small mb-4" style="color:var(--text-muted);">
                Masuk untuk mendaftar ke organisasi mahasiswa dan melihat dashboard aktivitasmu.
            </p>
            <div class="d-grid gap-2">
                <a href="index.php?action=login"
                   class="btn btn-primary fw-600 rounded-pill">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </a>
                <a href="index.php?action=register"
                   class="btn btn-outline-primary fw-600 rounded-pill">
                    <i class="fas fa-user-plus me-2"></i>Daftar Akun
                </a>
            </div>

            <!-- Separator -->
            <div class="d-flex align-items-center gap-2 my-3">
                <hr class="flex-grow-1 m-0" style="border-color:var(--border-color);">
                <small style="color:var(--text-muted);">atau</small>
                <hr class="flex-grow-1 m-0" style="border-color:var(--border-color);">
            </div>
            <small style="color:var(--text-muted);">
                <i class="fas fa-info-circle me-1"></i>
                Kamu tetap bisa menjelajahi organisasi tanpa login.
            </small>
        </div>

    </div>

<?php endif; ?>

</div><!-- /col-md-3 -->