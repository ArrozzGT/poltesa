<?php include __DIR__ . '/../templates/header.php'; ?>

<?php
// Load stats for sidebar badge
$jumlah_pending = is_array($pendaftar) ? count(array_filter($pendaftar, fn($p) => in_array($p['status_pendaftaran'], ['pending','interview']))) : 0;
$org_id = $_SESSION['admin_org_id'];
$orgName = '-';
// Try to get org name from session or query
if (isset($organisasi)) $orgName = $organisasi['nama_organisasi'] ?? '-';
$stats = ['pending' => $jumlah_pending, 'nama_organisasi' => $orgName, 'anggota' => 0, 'progja' => 0];

$total = count($pendaftar);
$pending_count = 0;
$interview_count = 0;
$approved_count = 0;
$rejected_count = 0;
foreach ($pendaftar as $p) {
    if ($p['status_pendaftaran'] == 'pending')   $pending_count++;
    if ($p['status_pendaftaran'] == 'interview') $interview_count++;
    if ($p['status_pendaftaran'] == 'approved')  $approved_count++;
    if ($p['status_pendaftaran'] == 'rejected')  $rejected_count++;
}
$filter = $_GET['filter'] ?? 'all';
?>

<style>
.admin-wrap { display:flex; min-height:calc(100vh - 80px); background:#f0f4ff; }
.admin-sidebar {
    width:270px; flex-shrink:0;
    background:linear-gradient(180deg,#1e40af,#1d4ed8 40%,#2563eb);
    padding:0; position:sticky; top:72px; height:calc(100vh - 72px);
    overflow-y:auto; display:flex; flex-direction:column;
    box-shadow:4px 0 20px rgba(37,99,235,0.15); scrollbar-width:none;
}
.admin-sidebar::-webkit-scrollbar { display:none; }
.sidebar-org-header { padding:24px 20px 16px; border-bottom:1px solid rgba(255,255,255,0.1); }
.sidebar-logo-wrap { width:60px;height:60px;border-radius:14px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px solid rgba(255,255,255,0.25);flex-shrink:0; }
.sidebar-logo-wrap img { width:100%;height:100%;object-fit:cover; }
.sidebar-org-name { color:#fff;font-weight:700;font-size:0.95rem;line-height:1.2; }
.sidebar-org-badge { display:inline-block;margin-top:6px;background:rgba(255,255,255,0.2);color:rgba(255,255,255,0.85);font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:999px; }
.sidebar-nav { padding:12px 10px; flex-grow:1; }
.sidebar-section-label { font-size:0.65rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,0.45);padding:14px 12px 6px; }
.sidebar-link { display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:10px;color:rgba(255,255,255,0.75);text-decoration:none;font-weight:500;font-size:0.88rem;transition:all 0.2s;margin-bottom:2px;position:relative; }
.sidebar-link:hover { background:rgba(255,255,255,0.12);color:#fff; }
.sidebar-link.active { background:rgba(255,255,255,0.2);color:#fff;font-weight:700;box-shadow:0 2px 8px rgba(0,0,0,0.15); }
.sidebar-link .link-icon { width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-size:0.85rem;flex-shrink:0; }
.sidebar-link.active .link-icon { background:rgba(255,255,255,0.25); }
.badge-sidebar { margin-left:auto;background:#ef4444;color:#fff;font-size:0.65rem;font-weight:700;padding:2px 7px;border-radius:999px; }
.sidebar-footer { padding:12px 10px 16px;border-top:1px solid rgba(255,255,255,0.1); }
.sidebar-logout-btn { display:flex;align-items:center;gap:10px;width:100%;padding:11px 14px;border-radius:10px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.25);color:#fca5a5;font-weight:600;font-size:0.88rem;text-decoration:none;transition:all 0.2s; }
.sidebar-logout-btn:hover { background:rgba(239,68,68,0.3);color:#fff; }
.admin-main { flex:1;padding:28px 32px;overflow:hidden; }

/* Seleksi Specific */
.page-header-bar {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px;
}
.stat-mini-grid {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 12px;
    margin-bottom: 24px;
}
.stat-mini {
    background: #fff; border-radius: 14px;
    padding: 16px 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid transparent;
    transition: transform 0.2s;
}
.stat-mini:hover { transform: translateY(-2px); }
.stat-mini.blue  { border-left-color: #2563eb; }
.stat-mini.yellow{ border-left-color: #f59e0b; }
.stat-mini.green { border-left-color: #10b981; }
.stat-mini.red   { border-left-color: #ef4444; }
.stat-mini-value { font-size:1.6rem;font-weight:800;line-height:1; }
.stat-mini-label { font-size:0.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-top:4px; }

.filter-tabs { display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap; }
.filter-tab {
    padding: 7px 18px; border-radius: 999px;
    font-size: 0.82rem; font-weight: 600;
    text-decoration: none; color: #64748b;
    background: #fff; border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.filter-tab:hover,.filter-tab.active {
    background: #2563eb; color: #fff; border-color: #2563eb;
}

/* Table */
.modern-table { width:100%; border-collapse:separate; border-spacing:0; }
.modern-table thead th {
    background: #f8fafc;
    padding: 12px 16px;
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.5px; color: #64748b;
    border-bottom: 1px solid #e2e8f0;
    white-space: nowrap;
}
.modern-table tbody tr {
    background: #fff;
    transition: background 0.15s;
}
.modern-table tbody tr:hover { background: #f8fafc; }
.modern-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.87rem; color: #334155;
    vertical-align: middle;
}
.modern-table tbody tr:last-child td { border-bottom: none; }

.applicant-cell { display:flex;align-items:center;gap:12px; }
.applicant-ava {
    width:40px;height:40px;border-radius:10px;object-fit:cover;flex-shrink:0;
    background:#eff6ff;display:flex;align-items:center;justify-content:center;
    font-weight:700;font-size:0.95rem;color:#2563eb;
}
.name-bold { font-weight:700;color:#1e293b;font-size:0.9rem; }
.nim-muted { font-size:0.75rem;color:#94a3b8; }
.badge-status { display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:999px;font-size:0.75rem;font-weight:700; }
.status-pending  { background:#fef9c3;color:#a16207; }
.status-interview{ background:#dbeafe;color:#1d4ed8; }
.status-approved { background:#dcfce7;color:#15803d; }
.status-rejected { background:#fee2e2;color:#b91c1c; }
.btn-xs { width:30px;height:30px;border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:0.75rem;transition:all 0.2s; }
.btn-xs.view { background:#eff6ff;color:#2563eb; }
.btn-xs.view:hover { background:#dbeafe; }
.btn-xs.ok { background:#dcfce7;color:#15803d; }
.btn-xs.ok:hover { background:#bbf7d0; }
.btn-xs.nope { background:#fee2e2;color:#b91c1c; }
.btn-xs.nope:hover { background:#fecaca; }
.btn-xs.talk { background:#fef9c3;color:#a16207; }
.btn-xs.talk:hover { background:#fef08a; }

.panel-wrap { background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,0.05);overflow:hidden; }

.toast-container-custom { position:fixed;top:20px;right:20px;z-index:9999; }
.toast-custom { background:#fff;border-radius:12px;padding:14px 18px;box-shadow:0 10px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:12px;min-width:280px;animation:slideToast 0.3s ease;border-left:4px solid #10b981;margin-bottom:10px; }
@keyframes slideToast { from{transform:translateX(100%);opacity:0} to{transform:translateX(0);opacity:1} }

@media(max-width:992px){
    .admin-wrap{flex-direction:column;}
    .admin-sidebar{width:100%;height:auto;position:static;flex-direction:row;overflow-x:auto;}
    .sidebar-org-header{display:none;}
    .sidebar-nav{display:flex;flex-direction:row;padding:8px;white-space:nowrap;}
    .sidebar-section-label{display:none;}
    .sidebar-link{flex-direction:row;flex-shrink:0;margin-bottom:0;margin-right:4px;padding:8px 14px;}
    .stat-mini-grid{grid-template-columns:repeat(2,1fr);}
    .admin-main{padding:16px;}
}
</style>

<div class="admin-wrap">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <?php
        $logo = $organisasi['logo'] ?? '';
        $logoSrc = null;
        if (!empty($logo)) {
            if (file_exists('assets/images/profil/' . $logo)) $logoSrc = 'assets/images/profil/' . $logo;
            elseif (file_exists('assets/images/ormawa/' . $logo)) $logoSrc = 'assets/images/ormawa/' . $logo;
        }
        $cur = $_GET['action'] ?? 'ormawa_seleksi';
        ?>
        <div class="sidebar-org-header">
            <div class="d-flex align-items-center gap-3">
                <div class="sidebar-logo-wrap">
                    <?php if ($logoSrc): ?><img src="<?php echo htmlspecialchars($logoSrc); ?>" alt="">
                    <?php else: ?><i class="fas fa-university" style="color:#fff;font-size:1.4rem;"></i><?php endif; ?>
                </div>
                <div>
                    <div class="sidebar-org-name"><?php echo htmlspecialchars($orgName); ?></div>
                    <span class="sidebar-org-badge"><?php echo htmlspecialchars($organisasi['jenis_organisasi'] ?? 'UKM'); ?></span>
                </div>
            </div>
        </div>
        <div class="sidebar-nav">
            <div class="sidebar-section-label">Menu Utama</div>
            <a href="index.php?action=ormawa_dashboard" class="sidebar-link <?php echo $cur=='ormawa_dashboard'?'active':''; ?>"><span class="link-icon"><i class="fas fa-tachometer-alt"></i></span>Dashboard</a>
            <div class="sidebar-section-label">Manajemen</div>
            <a href="index.php?action=ormawa_seleksi" class="sidebar-link <?php echo $cur=='ormawa_seleksi'?'active':''; ?>"><span class="link-icon"><i class="fas fa-user-check"></i></span>Seleksi Anggota<?php if($jumlah_pending>0): ?><span class="badge-sidebar"><?php echo $jumlah_pending; ?></span><?php endif; ?></a>
            <a href="index.php?action=ormawa_kelola_anggota" class="sidebar-link <?php echo $cur=='ormawa_kelola_anggota'?'active':''; ?>"><span class="link-icon"><i class="fas fa-users"></i></span>Kelola Anggota</a>
            <a href="index.php?action=ormawa_kelola_divisi" class="sidebar-link <?php echo $cur=='ormawa_kelola_divisi'?'active':''; ?>"><span class="link-icon"><i class="fas fa-sitemap"></i></span>Kelola Divisi</a>
            <div class="sidebar-section-label">Konten</div>
            <a href="index.php?action=ormawa_kegiatan" class="sidebar-link <?php echo $cur=='ormawa_kegiatan'?'active':''; ?>"><span class="link-icon"><i class="fas fa-camera"></i></span>Kegiatan</a>
            <a href="index.php?action=ormawa_progja" class="sidebar-link <?php echo $cur=='ormawa_progja'?'active':''; ?>"><span class="link-icon"><i class="fas fa-tasks"></i></span>Program Kerja</a>
            <a href="index.php?action=ormawa_laporan" class="sidebar-link <?php echo $cur=='ormawa_laporan'?'active':''; ?>"><span class="link-icon"><i class="fas fa-file-alt"></i></span>Laporan</a>
            <a href="index.php?action=ormawa_pesan" class="sidebar-link <?php echo $cur=='ormawa_pesan'?'active':''; ?>"><span class="link-icon"><i class="fas fa-bullhorn"></i></span>Broadcast</a>
            <div class="sidebar-section-label">Organisasi</div>
            <a href="index.php?action=ormawa_edit_profil" class="sidebar-link <?php echo $cur=='ormawa_edit_profil'?'active':''; ?>"><span class="link-icon"><i class="fas fa-edit"></i></span>Edit Profil Org</a>
            <a href="index.php?action=organisasi" class="sidebar-link"><span class="link-icon"><i class="fas fa-globe"></i></span>Lihat Portal</a>
        </div>
        <div class="sidebar-footer">
            <a href="index.php?action=logout" class="sidebar-logout-btn" onclick="return confirm('Yakin logout?')"><i class="fas fa-sign-out-alt"></i>Logout Sistem</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="admin-main">
        <div class="page-header-bar">
            <div>
                <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin:0;">Seleksi Pendaftar</h1>
                <p style="font-size:0.85rem;color:#64748b;margin:0;">Kelola anggota baru yang mendaftar ke organisasi Anda</p>
            </div>
            <a href="index.php?action=ormawa_dashboard" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                <i class="fas fa-arrow-left me-2"></i>Dashboard
            </a>
        </div>

        <!-- Mini stats -->
        <div class="stat-mini-grid">
            <div class="stat-mini blue">
                <div class="stat-mini-value" style="color:#2563eb;"><?php echo $total; ?></div>
                <div class="stat-mini-label">Total Pelamar</div>
            </div>
            <div class="stat-mini yellow">
                <div class="stat-mini-value" style="color:#f59e0b;"><?php echo $pending_count; ?></div>
                <div class="stat-mini-label">Perlu Review</div>
            </div>
            <div class="stat-mini blue" style="border-left-color:#0ea5e9;">
                <div class="stat-mini-value" style="color:#0ea5e9;"><?php echo $interview_count; ?></div>
                <div class="stat-mini-label">Wawancara</div>
            </div>
            <div class="stat-mini green">
                <div class="stat-mini-value" style="color:#10b981;"><?php echo $approved_count; ?></div>
                <div class="stat-mini-label">Diterima</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="?action=ormawa_seleksi&filter=all" class="filter-tab <?php echo $filter=='all'?'active':''; ?>">Semua <span class="ms-1"><?php echo $total; ?></span></a>
            <a href="?action=ormawa_seleksi&filter=pending" class="filter-tab <?php echo $filter=='pending'?'active':''; ?>">Pending <span class="ms-1"><?php echo $pending_count; ?></span></a>
            <a href="?action=ormawa_seleksi&filter=interview" class="filter-tab <?php echo $filter=='interview'?'active':''; ?>">Wawancara <span class="ms-1"><?php echo $interview_count; ?></span></a>
            <a href="?action=ormawa_seleksi&filter=approved" class="filter-tab <?php echo $filter=='approved'?'active':''; ?>">Diterima <span class="ms-1"><?php echo $approved_count; ?></span></a>
            <a href="?action=ormawa_seleksi&filter=rejected" class="filter-tab <?php echo $filter=='rejected'?'active':''; ?>">Ditolak <span class="ms-1"><?php echo $rejected_count; ?></span></a>
        </div>

        <!-- Table Panel -->
        <div class="panel-wrap">
            <?php
            $filtered = array_filter($pendaftar, function($p) use ($filter) {
                if ($filter === 'all') return true;
                return $p['status_pendaftaran'] === $filter;
            });
            ?>
            <?php if (empty($filtered)): ?>
                <div class="text-center py-5">
                    <div style="font-size:3rem;opacity:0.2;margin-bottom:12px;">📭</div>
                    <div style="font-weight:700;color:#64748b;">Tidak ada data</div>
                    <div style="font-size:0.82rem;color:#94a3b8;">Tidak ada pendaftar dengan filter ini.</div>
                </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Pendaftar</th>
                            <th>Jabatan Dilamar</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filtered as $row):
                            $fotoP = !empty($row['foto_profil']) ? 'assets/images/profil/' . $row['foto_profil'] : null;
                            $fotoOk = $fotoP && file_exists($fotoP);
                            $inisial = strtoupper(substr($row['nama_lengkap']??'A', 0, 1));
                            $sc = 'pending';
                            if ($row['status_pendaftaran'] == 'interview') $sc = 'interview';
                            elseif ($row['status_pendaftaran'] == 'approved') $sc = 'approved';
                            elseif ($row['status_pendaftaran'] == 'rejected') $sc = 'rejected';
                            $stText = ['pending'=>'Pending','interview'=>'Wawancara','approved'=>'Diterima','rejected'=>'Ditolak'];
                            $stIcon = ['pending'=>'⏳','interview'=>'💬','approved'=>'✅','rejected'=>'❌'];
                        ?>
                        <tr>
                            <td>
                                <div class="applicant-cell">
                                    <?php if ($fotoOk): ?>
                                        <img src="<?php echo htmlspecialchars($fotoP); ?>" class="applicant-ava">
                                    <?php else: ?>
                                        <div class="applicant-ava"><?php echo $inisial; ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="name-bold"><?php echo htmlspecialchars($row['nama_lengkap']); ?></div>
                                        <div class="nim-muted"><?php echo htmlspecialchars($row['nim']); ?> &bull; <?php echo htmlspecialchars($row['jurusan']??'-'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="background:#eff6ff;color:#2563eb;font-size:0.75rem;font-weight:700;padding:4px 12px;border-radius:999px;">
                                    <?php echo htmlspecialchars($row['nama_jabatan']??'-'); ?>
                                </span>
                            </td>
                            <td style="color:#64748b;font-size:0.82rem;">
                                <i class="far fa-calendar me-1"></i><?php echo date('d M Y', strtotime($row['tanggal_daftar'])); ?>
                            </td>
                            <td>
                                <span class="badge-status status-<?php echo $sc; ?>">
                                    <?php echo $stIcon[$sc]; ?> <?php echo $stText[$sc]; ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn-xs view" title="Detail" onclick='openDetailModal(<?php echo json_encode($row); ?>, {})'>
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if (in_array($row['status_pendaftaran'], ['pending','interview'])): ?>
                                    <button class="btn-xs talk" title="Wawancara" onclick="quickAksi(<?php echo $row['pendaftaran_kepengurusan_id']; ?>, 'wawancara', '<?php echo addslashes($row['nama_lengkap']); ?>')">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                    <button class="btn-xs ok" title="Terima" onclick="quickAksi(<?php echo $row['pendaftaran_kepengurusan_id']; ?>, 'terima', '<?php echo addslashes($row['nama_lengkap']); ?>')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn-xs nope" title="Tolak" onclick="quickAksi(<?php echo $row['pendaftaran_kepengurusan_id']; ?>, 'tolak', '<?php echo addslashes($row['nama_lengkap']); ?>')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<!-- Modal Detail & Aksi -->
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
                                <label class="small fw-bold text-muted">Status Saat Ini</label>
                                <input type="text" class="form-control form-control-sm bg-white" id="modalStatusDisplay" readonly style="border-radius:8px;">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Alasan terima/tolak..." style="border-radius:10px;"></textarea>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" name="aksi" value="interview" class="btn btn-info text-white fw-bold rounded-pill"><i class="fas fa-comments me-2"></i>Panggil Wawancara</button>
                                <button type="submit" name="aksi" value="terima" class="btn btn-success fw-bold rounded-pill" onclick="return confirm('Terima anggota ini?')"><i class="fas fa-check-circle me-2"></i>Terima Anggota</button>
                                <button type="submit" name="aksi" value="tolak" class="btn btn-outline-danger fw-bold rounded-pill" onclick="return confirm('Tolak pendaftar ini?')"><i class="fas fa-times-circle me-2"></i>Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Aksi Modal -->
<div class="modal fade" id="quickAksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
            <div class="modal-body text-center p-4">
                <div id="qaIcon" style="font-size:2.5rem;margin-bottom:10px;"></div>
                <h5 class="fw-bold" id="qaTitle"></h5>
                <p class="text-muted small" id="qaMsg"></p>
                <textarea id="qaCatatan" class="form-control mb-3" rows="2" placeholder="Catatan opsional..." style="border-radius:10px;"></textarea>
                <form method="POST" action="" id="qaForm">
                    <input type="hidden" name="pendaftaran_id" id="qaId">
                    <input type="hidden" name="aksi" id="qaAksi">
                    <input type="hidden" name="catatan" id="qaCatatanH">
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn rounded-pill px-4 fw-bold" id="qaSubmit">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container-custom" id="toastContainer"></div>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<script>
function openDetailModal(data) {
    document.getElementById('modalName').textContent      = data.nama_lengkap ?? '-';
    document.getElementById('modalJabatan').textContent   = data.nama_jabatan ?? '-';
    document.getElementById('modalNim').textContent       = data.nim ?? '-';
    document.getElementById('modalMotivasi').innerText    = data.motivasi ?? '-';
    document.getElementById('modalPengalaman').innerText  = data.pengalaman_organisasi ?? '-';
    document.getElementById('formPendaftaranId').value    = data.pendaftaran_kepengurusan_id;
    document.getElementById('modalStatusDisplay').value   = (data.status_pendaftaran ?? 'pending').toUpperCase();
    document.getElementById('modalAvatar').textContent    = (data.nama_lengkap ?? 'A').charAt(0).toUpperCase();
    new bootstrap.Modal(document.getElementById('adminDetailModal')).show();
}
function quickAksi(pid, aksi, nama) {
    document.getElementById('qaId').value   = pid;
    document.getElementById('qaAksi').value = aksi;
    const icons = {terima:'✅', tolak:'❌', wawancara:'💬'};
    const titles = {terima:'Terima Anggota?', tolak:'Tolak Pendaftar?', wawancara:'Jadwalkan Wawancara?'};
    const colors = {terima:'btn-success', tolak:'btn-danger', wawancara:'btn-info text-white'};
    document.getElementById('qaIcon').innerHTML  = icons[aksi] || '❓';
    document.getElementById('qaTitle').textContent = titles[aksi] || 'Konfirmasi';
    document.getElementById('qaMsg').textContent  = `Aksi ini akan diterapkan untuk ${nama}.`;
    const btn = document.getElementById('qaSubmit');
    btn.className = `btn ${colors[aksi]} rounded-pill px-4 fw-bold`;
    btn.textContent = 'Ya, Lanjutkan';
    document.getElementById('qaForm').onsubmit = () => {
        document.getElementById('qaCatatanH').value = document.getElementById('qaCatatan').value;
    };
    new bootstrap.Modal(document.getElementById('quickAksiModal')).show();
}
function showToast(msg, type='success') {
    const c = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = 'toast-custom';
    t.style.borderLeftColor = type === 'success' ? '#10b981' : '#ef4444';
    t.innerHTML = `<i class="fas fa-${type==='success'?'check-circle text-success':'exclamation-circle text-danger'}" style="font-size:1.3rem;"></i><div><strong>${type==='success'?'Berhasil':'Gagal'}</strong><br><span style="font-size:0.82rem;color:#64748b;">${msg}</span></div>`;
    c.appendChild(t);
    setTimeout(() => t.remove(), 3500);
}
<?php if (isset($_GET['status'])): ?>
showToast('<?php echo addslashes($_GET['status'] === 'sukses' ? 'Aksi berhasil!' : 'Aksi gagal!'); ?>', '<?php echo $_GET['status'] === 'sukses' ? 'success' : 'error'; ?>');
<?php endif; ?>
</script>