<?php include 'views/templates/header.php'; ?>

<style>
/* =========================================================
   ADMIN ORMAWA — DESIGN SYSTEM
   ========================================================= */
.admin-wrap {
    display: flex;
    min-height: calc(100vh - 80px);
    background: #f0f4ff;
}

/* ---- SIDEBAR ---- */
.admin-sidebar {
    width: 270px;
    flex-shrink: 0;
    background: linear-gradient(180deg, #1e40af 0%, #1d4ed8 40%, #2563eb 100%);
    padding: 0;
    position: sticky;
    top: 72px;
    height: calc(100vh - 72px);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 20px rgba(37,99,235,0.15);
    transition: all 0.3s ease;
    scrollbar-width: none;
}
.admin-sidebar::-webkit-scrollbar { display: none; }

.sidebar-org-header {
    padding: 24px 20px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.sidebar-logo-wrap {
    width: 60px; height: 60px;
    border-radius: 14px;
    background: rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 12px;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.25);
    flex-shrink: 0;
}
.sidebar-logo-wrap img { width: 100%; height: 100%; object-fit: cover; }
.sidebar-org-name { color: #fff; font-weight: 700; font-size: 1rem; line-height: 1.2; }
.sidebar-org-badge {
    display: inline-block; margin-top: 6px;
    background: rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.85);
    font-size: 0.7rem; font-weight: 600;
    padding: 3px 10px; border-radius: 999px;
}

.sidebar-nav { padding: 12px 10px; flex-grow: 1; }
.sidebar-section-label {
    font-size: 0.65rem; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: rgba(255,255,255,0.45);
    padding: 14px 12px 6px;
}
.sidebar-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500; font-size: 0.88rem;
    transition: all 0.2s;
    margin-bottom: 2px;
    position: relative;
}
.sidebar-link:hover {
    background: rgba(255,255,255,0.12);
    color: #fff;
}
.sidebar-link.active {
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.sidebar-link .link-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: rgba(255,255,255,0.1);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
}
.sidebar-link.active .link-icon { background: rgba(255,255,255,0.25); }
.badge-sidebar {
    margin-left: auto;
    background: #ef4444; color: #fff;
    font-size: 0.65rem; font-weight: 700;
    padding: 2px 7px; border-radius: 999px;
}
.sidebar-footer {
    padding: 12px 10px 16px;
    border-top: 1px solid rgba(255,255,255,0.1);
}
.sidebar-logout-btn {
    display: flex; align-items: center; gap: 10px;
    width: 100%; padding: 11px 14px;
    border-radius: 10px;
    background: rgba(239,68,68,0.15);
    border: 1px solid rgba(239,68,68,0.25);
    color: #fca5a5;
    font-weight: 600; font-size: 0.88rem;
    text-decoration: none; cursor: pointer;
    transition: all 0.2s;
}
.sidebar-logout-btn:hover {
    background: rgba(239,68,68,0.3); color: #fff;
}

/* ---- MAIN CONTENT ---- */
.admin-main { flex: 1; padding: 28px 32px; overflow: hidden; }

.page-title { font-size: 1.4rem; font-weight: 800; color: #1e293b; }
.page-subtitle { font-size: 0.85rem; color: #64748b; }

/* ---- WELCOME CARD ---- */
.welcome-card {
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    border-radius: 18px;
    padding: 28px 32px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
}
.welcome-card::after {
    content: '';
    position: absolute; top: -30px; right: -30px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
}
.welcome-card::before {
    content: '';
    position: absolute; bottom: -40px; right: 100px;
    width: 150px; height: 150px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

/* ---- STAT CARDS ---- */
.stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
.stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    border: none;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative; overflow: hidden;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
.stat-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; margin-bottom: 14px;
}
.stat-value { font-size: 2rem; font-weight: 800; line-height: 1; color: #1e293b; }
.stat-label { font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }
.stat-card .bg-deco {
    position: absolute; right: -10px; bottom: -10px;
    font-size: 5rem; opacity: 0.06; color: #1e293b;
}

/* ---- CONTENT GRID ---- */
.content-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; }
.panel {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
}
.panel-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
}
.panel-title { font-weight: 700; font-size: 0.95rem; color: #1e293b; }
.panel-body { padding: 0; }

/* ---- APPLICANT ROWS ---- */
.applicant-row {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 22px;
    border-bottom: 1px solid #f8fafc;
    transition: background 0.15s;
}
.applicant-row:hover { background: #f8fafc; }
.applicant-row:last-child { border-bottom: none; }
.applicant-avatar {
    width: 44px; height: 44px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
    background: #eff6ff;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1rem; color: #2563eb;
}
.applicant-info { flex: 1; min-width: 0; }
.applicant-name { font-weight: 600; font-size: 0.9rem; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.applicant-nim { font-size: 0.75rem; color: #94a3b8; }
.applicant-jabatan { font-size: 0.72rem; background: #eff6ff; color: #2563eb; border-radius: 6px; padding: 2px 8px; font-weight: 600; }
.action-btn-grp { display: flex; gap: 6px; flex-shrink: 0; }
.btn-terima { background: #10b981; border: none; color: #fff; width: 32px; height: 32px; border-radius: 8px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
.btn-tolak  { background: #ef4444; border: none; color: #fff; width: 32px; height: 32px; border-radius: 8px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
.btn-detail { background: #eff6ff; border: none; color: #2563eb; width: 32px; height: 32px; border-radius: 8px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
.btn-terima:hover { background: #059669; }
.btn-tolak:hover  { background: #b91c1c; }
.btn-detail:hover { background: #dbeafe; }

/* ---- QUICK ACTION ---- */
.quick-action-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 16px; }
.qa-btn {
    border-radius: 12px;
    padding: 16px 12px;
    text-align: center;
    text-decoration: none;
    border: 1.5px solid #e2e8f0;
    background: #f8fafc;
    color: #334155;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.2s;
    display: flex; flex-direction: column;
    align-items: center; gap: 8px;
}
.qa-btn:hover {
    border-color: #2563eb; background: #eff6ff; color: #2563eb;
    transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37,99,235,0.15);
}
.qa-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
}

/* ---- TOAST ---- */
.toast-container-custom {
    position: fixed; top: 20px; right: 20px; z-index: 9999;
}
.toast-custom {
    background: #fff; border-radius: 12px;
    padding: 14px 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex; align-items: center; gap: 12px;
    min-width: 300px;
    animation: slideToast 0.3s ease;
    border-left: 4px solid #10b981;
}
@keyframes slideToast {
    from { transform: translateX(100%); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}

/* ---- MOBILE ---- */
#mobileSidebarToggle { display: none; }
@media (max-width: 992px) {
    .admin-wrap { flex-direction: column; }
    .admin-sidebar { width: 100%; height: auto; position: static; flex-direction: row; overflow-x: auto; }
    .sidebar-org-header { display: none; }
    .sidebar-nav { display: flex; flex-direction: row; padding: 8px; white-space: nowrap; }
    .sidebar-section-label { display: none; }
    .sidebar-link { flex-direction: row; flex-shrink: 0; margin-bottom: 0; margin-right: 4px; padding: 8px 14px; }
    .stat-grid { grid-template-columns: repeat(2, 1fr); }
    .content-grid { grid-template-columns: 1fr; }
    .admin-main { padding: 16px; }
}
</style>

<div class="admin-wrap">
    <!-- ======= SIDEBAR ======= -->
    <aside class="admin-sidebar">
        <?php
        $logo = $organisasi['logo'] ?? '';
        $logoSrc = null;
        if (!empty($logo)) {
            if (file_exists('assets/images/profil/' . $logo)) $logoSrc = 'assets/images/profil/' . $logo;
            elseif (file_exists('assets/images/ormawa/' . $logo)) $logoSrc = 'assets/images/ormawa/' . $logo;
        }
        $orgName = $organisasi['nama_organisasi'] ?? 'Organisasi';
        $jenis = $organisasi['jenis_organisasi'] ?? 'UKM';
        $cur = $_GET['action'] ?? 'ormawa_dashboard';
        ?>
        <!-- Org Header -->
        <div class="sidebar-org-header">
            <div class="d-flex align-items-center gap-3">
                <div class="sidebar-logo-wrap">
                    <?php if ($logoSrc): ?>
                        <img src="<?php echo htmlspecialchars($logoSrc); ?>" alt="Logo">
                    <?php else: ?>
                        <i class="fas fa-university" style="color:#fff;font-size:1.4rem;"></i>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="sidebar-org-name"><?php echo htmlspecialchars($orgName); ?></div>
                    <span class="sidebar-org-badge"><?php echo htmlspecialchars($jenis); ?></span>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <div class="sidebar-nav">
            <div class="sidebar-section-label">Menu Utama</div>

            <a href="index.php?action=ormawa_dashboard" class="sidebar-link <?php echo ($cur=='ormawa_dashboard') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-tachometer-alt"></i></span>
                Dashboard
            </a>

            <div class="sidebar-section-label">Manajemen</div>

            <a href="index.php?action=ormawa_seleksi" class="sidebar-link <?php echo ($cur=='ormawa_seleksi') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-user-check"></i></span>
                Seleksi Anggota
                <?php if ($stats['pending'] > 0): ?>
                    <span class="badge-sidebar"><?php echo $stats['pending']; ?></span>
                <?php endif; ?>
            </a>

            <a href="index.php?action=ormawa_kelola_anggota" class="sidebar-link <?php echo ($cur=='ormawa_kelola_anggota') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-users"></i></span>
                Kelola Anggota
            </a>

            <a href="index.php?action=ormawa_kelola_divisi" class="sidebar-link <?php echo ($cur=='ormawa_kelola_divisi') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-sitemap"></i></span>
                Kelola Divisi
            </a>

            <div class="sidebar-section-label">Konten</div>

            <a href="index.php?action=ormawa_kegiatan" class="sidebar-link <?php echo ($cur=='ormawa_kegiatan') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-camera"></i></span>
                Kegiatan
            </a>

            <a href="index.php?action=ormawa_progja" class="sidebar-link <?php echo ($cur=='ormawa_progja') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-tasks"></i></span>
                Program Kerja
            </a>

            <a href="index.php?action=ormawa_laporan" class="sidebar-link <?php echo ($cur=='ormawa_laporan') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-file-alt"></i></span>
                Laporan
            </a>

            <a href="index.php?action=ormawa_pesan" class="sidebar-link <?php echo ($cur=='ormawa_pesan') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-bullhorn"></i></span>
                Broadcast
            </a>

            <div class="sidebar-section-label">Organisasi</div>

            <a href="index.php?action=ormawa_edit_profil" class="sidebar-link <?php echo ($cur=='ormawa_edit_profil') ? 'active' : ''; ?>">
                <span class="link-icon"><i class="fas fa-edit"></i></span>
                Edit Profil Org
            </a>

            <a href="index.php?action=organisasi" class="sidebar-link">
                <span class="link-icon"><i class="fas fa-globe"></i></span>
                Lihat Portal
            </a>
        </div>

        <!-- Logout Footer -->
        <div class="sidebar-footer">
            <a href="index.php?action=logout" class="sidebar-logout-btn" onclick="return confirm('Yakin ingin keluar?')">
                <i class="fas fa-sign-out-alt"></i>
                Logout Sistem
            </a>
        </div>
    </aside>

    <!-- ======= MAIN CONTENT ======= -->
    <main class="admin-main">

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="page-title mb-0">Dashboard Admin <i class="fas fa-shield-alt text-primary ms-2" style="font-size:1.1rem;"></i></h1>
                <p class="page-subtitle mb-0">Selamat datang, kelola organisasi Anda di sini</p>
            </div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-600">
                <i class="far fa-calendar me-1"></i><?php echo date('d M Y'); ?>
            </span>
        </div>

        <!-- Welcome Card -->
        <div class="welcome-card">
            <div class="row align-items-center position-relative z-1">
                <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width:50px;height:50px;background:rgba(255,255,255,0.2);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div>
                            <div style="font-size:0.75rem;opacity:0.75;font-weight:600;text-transform:uppercase;letter-spacing:1px;">Admin Dashboard</div>
                            <h4 class="fw-bold mb-0" style="font-size:1.2rem;"><?php echo htmlspecialchars($stats['nama_organisasi']); ?></h4>
                        </div>
                    </div>
                    <p class="mb-0" style="opacity:0.8;font-size:0.9rem;">
                        <?php if ($stats['pending'] > 0): ?>
                            <i class="fas fa-bell me-2"></i>Ada <strong><?php echo $stats['pending']; ?> pendaftar</strong> yang menunggu keputusan Anda.
                        <?php else: ?>
                            <i class="fas fa-check-circle me-2"></i>Semua pendaftaran sudah diproses. Tidak ada antrian baru.
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <i class="fas fa-university" style="font-size:5rem;opacity:0.15;"></i>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="fas fa-users" style="color:#2563eb;"></i>
                </div>
                <div class="stat-value"><?php echo $stats['anggota']; ?></div>
                <div class="stat-label">Anggota Aktif</div>
                <i class="fas fa-users bg-deco"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef9c3;">
                    <i class="fas fa-user-clock" style="color:#ca8a04;"></i>
                </div>
                <div class="stat-value" style="color:<?php echo $stats['pending'] > 0 ? '#ca8a04' : '#1e293b'; ?>;"><?php echo $stats['pending']; ?></div>
                <div class="stat-label">Menunggu Review</div>
                <i class="fas fa-hourglass-half bg-deco"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="fas fa-tasks" style="color:#16a34a;"></i>
                </div>
                <div class="stat-value"><?php echo $stats['progja']; ?></div>
                <div class="stat-label">Program Kerja</div>
                <i class="fas fa-clipboard-list bg-deco"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#fdf4ff;">
                    <i class="fas fa-building" style="color:#9333ea;"></i>
                </div>
                <div class="stat-value"><?php echo $organisasi['jumlah_divisi'] ?? 0; ?></div>
                <div class="stat-label">Total Divisi</div>
                <i class="fas fa-sitemap bg-deco"></i>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">

            <!-- Pending Applicants Panel -->
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <div class="panel-title"><i class="fas fa-user-plus me-2 text-primary"></i>Pendaftaran Masuk</div>
                        <div style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">
                            <?php echo $stats['pending']; ?> menunggu keputusan
                        </div>
                    </div>
                    <a href="index.php?action=ormawa_seleksi" class="btn btn-sm btn-primary rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="panel-body">
                    <?php if (!empty($list_pending)): ?>
                        <?php foreach (array_slice($list_pending, 0, 6) as $p):
                            $fotoP = !empty($p['foto_profil']) ? 'assets/images/profil/' . $p['foto_profil'] : null;
                            $fotoOk = $fotoP && file_exists($fotoP);
                            $inisial = strtoupper(substr($p['nama_lengkap'], 0, 1));
                        ?>
                        <div class="applicant-row" id="row-<?php echo $p['pendaftaran_kepengurusan_id']; ?>">
                            <?php if ($fotoOk): ?>
                                <img src="<?php echo htmlspecialchars($fotoP); ?>" class="applicant-avatar">
                            <?php else: ?>
                                <div class="applicant-avatar"><?php echo $inisial; ?></div>
                            <?php endif; ?>
                            <div class="applicant-info">
                                <div class="applicant-name"><?php echo htmlspecialchars($p['nama_lengkap']); ?></div>
                                <div class="applicant-nim"><?php echo htmlspecialchars($p['nim']); ?> &bull; <?php echo date('d M', strtotime($p['tanggal_daftar'])); ?></div>
                                <span class="applicant-jabatan mt-1 d-inline-block"><?php echo htmlspecialchars($p['nama_jabatan']); ?></span>
                            </div>
                            <div class="action-btn-grp">
                                <button class="btn-detail" title="Detail" onclick='openDetailModal(<?php echo json_encode($p); ?>, {})'>
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-terima" title="Terima" onclick="aksiByCon(<?php echo $p['pendaftaran_kepengurusan_id']; ?>, 'terima', '<?php echo htmlspecialchars($p['nama_lengkap']); ?>')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn-tolak" title="Tolak" onclick="aksiByCon(<?php echo $p['pendaftaran_kepengurusan_id']; ?>, 'tolak', '<?php echo htmlspecialchars($p['nama_lengkap']); ?>')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div style="font-size:3rem;margin-bottom:12px;opacity:0.2;">✅</div>
                            <div style="font-weight:700;color:#64748b;">Tidak ada pendaftaran pending</div>
                            <div style="font-size:0.8rem;color:#94a3b8;">Semua sudah diproses</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="d-flex flex-column gap-4">
                <!-- Quick Actions -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title"><i class="fas fa-bolt me-2 text-warning"></i>Aksi Cepat</div>
                    </div>
                    <div class="quick-action-grid">
                        <a href="index.php?action=ormawa_seleksi" class="qa-btn">
                            <span class="qa-icon" style="background:#eff6ff;"><i class="fas fa-user-check" style="color:#2563eb;"></i></span>
                            Seleksi
                        </a>
                        <a href="index.php?action=ormawa_kegiatan" class="qa-btn">
                            <span class="qa-icon" style="background:#f0fdf4;"><i class="fas fa-camera" style="color:#16a34a;"></i></span>
                            Kegiatan
                        </a>
                        <a href="index.php?action=ormawa_progja" class="qa-btn">
                            <span class="qa-icon" style="background:#fdf4ff;"><i class="fas fa-tasks" style="color:#9333ea;"></i></span>
                            Progja
                        </a>
                        <a href="index.php?action=ormawa_pesan" class="qa-btn">
                            <span class="qa-icon" style="background:#fff7ed;"><i class="fas fa-bullhorn" style="color:#ea580c;"></i></span>
                            Broadcast
                        </a>
                        <a href="index.php?action=ormawa_edit_profil" class="qa-btn">
                            <span class="qa-icon" style="background:#f0f9ff;"><i class="fas fa-edit" style="color:#0284c7;"></i></span>
                            Edit Profil
                        </a>
                        <a href="index.php?action=ormawa_laporan" class="qa-btn">
                            <span class="qa-icon" style="background:#fef2f2;"><i class="fas fa-file-alt" style="color:#dc2626;"></i></span>
                            Laporan
                        </a>
                    </div>
                </div>

                <!-- Org Info Card -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title"><i class="fas fa-id-card me-2 text-info"></i>Info Organisasi</div>
                        <a href="index.php?action=ormawa_profil_lengkap" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Lihat</a>
                    </div>
                    <div style="padding:16px 22px;">
                        <div style="font-size:0.8rem;color:#64748b;margin-bottom:10px;">
                            <i class="fas fa-tag me-2 text-primary"></i>
                            <?php echo htmlspecialchars($organisasi['jenis_organisasi'] ?? '-'); ?>
                        </div>
                        <?php if (!empty($organisasi['no_whatsapp'])): ?>
                        <div style="font-size:0.8rem;color:#64748b;margin-bottom:10px;">
                            <i class="fab fa-whatsapp me-2 text-success"></i>
                            <?php echo htmlspecialchars($organisasi['no_whatsapp']); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($organisasi['tanggal_berdiri'])): ?>
                        <div style="font-size:0.8rem;color:#64748b;">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            Berdiri <?php echo date('d M Y', strtotime($organisasi['tanggal_berdiri'])); ?>
                        </div>
                        <?php endif; ?>
                        <a href="index.php?action=detail&id=<?php echo $_SESSION['admin_org_id']; ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill w-100 mt-3">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat Halaman Publik
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- ===== MODAL DETAIL ===== -->
<div class="modal fade" id="adminDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius:18px;overflow:hidden;">
            <div class="modal-header" style="background:linear-gradient(135deg,#2563eb,#7c3aed);border:none;">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-user-check me-2"></i>Review Pendaftar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-7 p-4" style="max-height:65vh;overflow-y:auto;">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1.3rem;font-weight:700;" id="modalAvatar">A</div>
                            <div>
                                <h5 class="fw-bold mb-0" id="modalName">-</h5>
                                <div class="d-flex gap-2 mt-1">
                                    <span class="badge bg-primary rounded-pill" id="modalJabatan">-</span>
                                    <span class="text-muted small" id="modalNim">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Motivasi</label>
                            <div style="background:#f8fafc;border-radius:10px;padding:12px;font-size:0.9rem;margin-top:4px;" id="modalMotivasi">-</div>
                        </div>
                        <div>
                            <label class="text-muted" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Pengalaman Organisasi</label>
                            <div style="background:#f8fafc;border-radius:10px;padding:12px;font-size:0.9rem;margin-top:4px;" id="modalPengalaman">-</div>
                        </div>
                    </div>
                    <div class="col-lg-5 p-4" style="background:#f8fafc;border-left:1px solid #e2e8f0;">
                        <h6 class="fw-bold mb-3">Keputusan</h6>
                        <form method="POST" action="">
                            <input type="hidden" name="pendaftaran_id" id="formPendaftaranId">
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Status</label>
                                <input type="text" class="form-control form-control-sm bg-white" id="modalStatusDisplay" readonly style="border-radius:8px;">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Alasan terima/tolak..." style="border-radius:10px;"></textarea>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="aksi" value="interview" class="btn btn-info text-white fw-bold rounded-pill">
                                    <i class="fas fa-comments me-2"></i>Panggil Wawancara
                                </button>
                                <button type="submit" name="aksi" value="terima" class="btn btn-success fw-bold rounded-pill" onclick="return confirm('Terima anggota ini?')">
                                    <i class="fas fa-check-circle me-2"></i>Terima Anggota
                                </button>
                                <button type="submit" name="aksi" value="tolak" class="btn btn-outline-danger fw-bold rounded-pill" onclick="return confirm('Tolak pendaftar ini?')">
                                    <i class="fas fa-times-circle me-2"></i>Tolak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI AKSI CEPAT -->
<div class="modal fade" id="aksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
            <div class="modal-body text-center p-4">
                <div id="aksiIcon" style="font-size:2.5rem;margin-bottom:12px;"></div>
                <h5 class="fw-bold" id="aksiTitle">Konfirmasi</h5>
                <p class="text-muted small" id="aksiMsg">-</p>
                <div class="mb-3">
                    <textarea id="aksiCatatan" class="form-control" rows="2" placeholder="Catatan (opsional)" style="border-radius:10px;"></textarea>
                </div>
                <form method="POST" action="" id="aksiForm">
                    <input type="hidden" name="pendaftaran_id" id="aksiPendaftaranId">
                    <input type="hidden" name="aksi" id="aksiValue">
                    <input type="hidden" name="catatan" id="aksiCatatanHidden">
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn rounded-pill px-4 fw-bold" id="aksiSubmitBtn">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container-custom" id="toastContainer"></div>

<?php include 'views/templates/footer.php'; ?>

<script>
// Modal Detail
function openDetailModal(data, jsonDetails) {
    document.getElementById('modalName').textContent    = data.nama_lengkap ?? '-';
    document.getElementById('modalJabatan').textContent = data.nama_jabatan ?? '-';
    document.getElementById('modalNim').textContent     = data.nim ?? '-';
    document.getElementById('modalMotivasi').innerText  = data.motivasi ?? '-';
    document.getElementById('modalPengalaman').innerText = data.pengalaman_organisasi ?? '-';
    document.getElementById('formPendaftaranId').value  = data.pendaftaran_kepengurusan_id;
    document.getElementById('modalStatusDisplay').value = (data.status_pendaftaran ?? 'pending').toUpperCase();
    document.getElementById('modalAvatar').textContent  = (data.nama_lengkap ?? 'A').charAt(0).toUpperCase();
    new bootstrap.Modal(document.getElementById('adminDetailModal')).show();
}

// Aksi Cepat (Terima/Tolak dari row)
function aksiByCon(pid, aksi, nama) {
    document.getElementById('aksiPendaftaranId').value = pid;
    document.getElementById('aksiValue').value = aksi;
    const isTerma = (aksi === 'terima');
    document.getElementById('aksiIcon').innerHTML = isTerma ? '✅' : '❌';
    document.getElementById('aksiTitle').textContent = isTerma ? 'Terima Anggota?' : 'Tolak Pendaftar?';
    document.getElementById('aksiMsg').textContent = (isTerma ? 'Kamu akan menerima ' : 'Kamu akan menolak ') + nama + '.';
    const btn = document.getElementById('aksiSubmitBtn');
    btn.className = isTerma ? 'btn btn-success rounded-pill px-4 fw-bold' : 'btn btn-danger rounded-pill px-4 fw-bold';
    btn.textContent = isTerma ? 'Ya, Terima' : 'Ya, Tolak';
    document.getElementById('aksiForm').onsubmit = function() {
        document.getElementById('aksiCatatanHidden').value = document.getElementById('aksiCatatan').value;
    };
    new bootstrap.Modal(document.getElementById('aksiModal')).show();
}

// Show toast
function showToast(msg, type='success') {
    const c = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = 'toast-custom';
    t.style.borderLeftColor = (type==='success') ? '#10b981' : '#ef4444';
    t.innerHTML = `<i class="fas fa-${type==='success'?'check-circle text-success':'exclamation-circle text-danger'}" style="font-size:1.3rem;"></i><div><strong>${type==='success'?'Berhasil':'Gagal'}</strong><br><span style="font-size:0.85rem;color:#64748b;">${msg}</span></div>`;
    c.appendChild(t);
    setTimeout(() => { t.remove(); }, 3500);
}

<?php if (isset($_GET['status'])): ?>
showToast('<?php echo $_GET['status'] === 'sukses' ? 'Aksi berhasil dilakukan!' : 'Aksi gagal!'; ?>', '<?php echo $_GET['status'] === 'sukses' ? 'success' : 'error'; ?>');
<?php endif; ?>
</script>