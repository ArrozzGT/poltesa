<?php include __DIR__ . '/../templates/header.php'; ?>

<?php
$org_id  = $_SESSION['admin_org_id'];
$orgName = '-';
if (isset($pengurus) && !empty($pengurus)) {
    // Try get from session
}
// Load org info for sidebar
$jumlah_pending = 0;
// Build a safe organisasi placeholder for sidebar
if (!isset($organisasi)) {
    $organisasi = ['nama_organisasi' => $_SESSION['nama_lengkap'] ?? 'Organisasi', 'jenis_organisasi' => 'UKM', 'logo' => ''];
}
$stats = ['pending' => 0, 'nama_organisasi' => $organisasi['nama_organisasi'], 'anggota' => count($pengurus ?? []), 'progja' => 0];
?>

<style>
/* Reuse admin-wrap */
.admin-wrap { display:flex; min-height:calc(100vh - 80px); background:#f0f4ff; }
.admin-sidebar { width:270px;flex-shrink:0;background:linear-gradient(180deg,#1e40af,#1d4ed8 40%,#2563eb);padding:0;position:sticky;top:72px;height:calc(100vh - 72px);overflow-y:auto;display:flex;flex-direction:column;box-shadow:4px 0 20px rgba(37,99,235,0.15);scrollbar-width:none; }
.admin-sidebar::-webkit-scrollbar{display:none;}
.sidebar-org-header{padding:24px 20px 16px;border-bottom:1px solid rgba(255,255,255,0.1);}
.sidebar-logo-wrap{width:60px;height:60px;border-radius:14px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px solid rgba(255,255,255,0.25);flex-shrink:0;}
.sidebar-logo-wrap img{width:100%;height:100%;object-fit:cover;}
.sidebar-org-name{color:#fff;font-weight:700;font-size:0.95rem;line-height:1.2;}
.sidebar-org-badge{display:inline-block;margin-top:6px;background:rgba(255,255,255,0.2);color:rgba(255,255,255,0.85);font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:999px;}
.sidebar-nav{padding:12px 10px;flex-grow:1;}
.sidebar-section-label{font-size:0.65rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,0.45);padding:14px 12px 6px;}
.sidebar-link{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:10px;color:rgba(255,255,255,0.75);text-decoration:none;font-weight:500;font-size:0.88rem;transition:all 0.2s;margin-bottom:2px;}
.sidebar-link:hover{background:rgba(255,255,255,0.12);color:#fff;}
.sidebar-link.active{background:rgba(255,255,255,0.2);color:#fff;font-weight:700;}
.sidebar-link .link-icon{width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-size:0.85rem;flex-shrink:0;}
.sidebar-link.active .link-icon{background:rgba(255,255,255,0.25);}
.badge-sidebar{margin-left:auto;background:#ef4444;color:#fff;font-size:0.65rem;font-weight:700;padding:2px 7px;border-radius:999px;}
.sidebar-footer{padding:12px 10px 16px;border-top:1px solid rgba(255,255,255,0.1);}
.sidebar-logout-btn{display:flex;align-items:center;gap:10px;width:100%;padding:11px 14px;border-radius:10px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.25);color:#fca5a5;font-weight:600;font-size:0.88rem;text-decoration:none;transition:all 0.2s;}
.sidebar-logout-btn:hover{background:rgba(239,68,68,0.3);color:#fff;}
.admin-main{flex:1;padding:28px 32px;overflow:hidden;}

/* Table */
.panel-wrap{background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,0.05);overflow:hidden;}
.panel-header{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid #f1f5f9;}
.panel-title{font-weight:700;font-size:0.95rem;color:#1e293b;}

.modern-table{width:100%;border-collapse:separate;border-spacing:0;}
.modern-table thead th{background:#f8fafc;padding:12px 16px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748b;border-bottom:1px solid #e2e8f0;white-space:nowrap;}
.modern-table tbody tr{background:#fff;transition:background 0.15s;}
.modern-table tbody tr:hover{background:#f8fafc;}
.modern-table tbody td{padding:14px 16px;border-bottom:1px solid #f1f5f9;font-size:0.87rem;color:#334155;vertical-align:middle;}
.modern-table tbody tr:last-child td{border-bottom:none;}

.member-cell{display:flex;align-items:center;gap:12px;}
.member-ava{width:42px;height:42px;border-radius:10px;object-fit:cover;flex-shrink:0;}
.member-ava-fallback{width:42px;height:42px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.95rem;color:#2563eb;flex-shrink:0;}
.name-bold{font-weight:700;color:#1e293b;font-size:0.9rem;}
.nim-muted{font-size:0.75rem;color:#94a3b8;}

.search-bar{display:flex;gap:10px;align-items:center;}
.search-input{border:1.5px solid #e2e8f0;border-radius:10px;padding:8px 14px;font-size:0.85rem;outline:none;transition:border-color 0.2s;width:220px;}
.search-input:focus{border-color:#2563eb;}

.btn-xs{width:30px;height:30px;border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:0.75rem;transition:all 0.2s;}
.btn-xs.nope{background:#fee2e2;color:#b91c1c;}
.btn-xs.nope:hover{background:#fecaca;}
.btn-xs.edit-jab{background:#eff6ff;color:#2563eb;}
.btn-xs.edit-jab:hover{background:#dbeafe;}

.export-btn{display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:10px;background:#10b981;color:#fff;font-size:0.82rem;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:background 0.2s;}
.export-btn:hover{background:#059669;color:#fff;}

.toast-container-custom{position:fixed;top:20px;right:20px;z-index:9999;}
.toast-custom{background:#fff;border-radius:12px;padding:14px 18px;box-shadow:0 10px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:12px;min-width:280px;animation:slideToast 0.3s ease;border-left:4px solid #10b981;margin-bottom:10px;}
@keyframes slideToast{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}

@media(max-width:992px){
    .admin-wrap{flex-direction:column;}
    .admin-sidebar{width:100%;height:auto;position:static;flex-direction:row;overflow-x:auto;}
    .sidebar-org-header{display:none;}
    .sidebar-nav{display:flex;flex-direction:row;padding:8px;white-space:nowrap;}
    .sidebar-section-label{display:none;}
    .sidebar-link{flex-direction:row;flex-shrink:0;margin-bottom:0;margin-right:4px;padding:8px 14px;}
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
        $cur = $_GET['action'] ?? 'ormawa_kelola_anggota';
        $orgName = $organisasi['nama_organisasi'] ?? '-';
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
            <a href="index.php?action=ormawa_seleksi" class="sidebar-link <?php echo $cur=='ormawa_seleksi'?'active':''; ?>"><span class="link-icon"><i class="fas fa-user-check"></i></span>Seleksi Anggota</a>
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
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin:0;">Kelola Anggota</h1>
                <p style="font-size:0.85rem;color:#64748b;margin:0;">
                    <i class="fas fa-users me-1"></i>Total <strong><?php echo count($pengurus ?? []); ?></strong> anggota aktif
                </p>
            </div>
            <a href="index.php?action=ormawa_dashboard" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                <i class="fas fa-arrow-left me-2"></i>Dashboard
            </a>
        </div>

        <!-- Table Panel -->
        <div class="panel-wrap">
            <div class="panel-header">
                <div class="panel-title">
                    <i class="fas fa-id-badge me-2 text-primary"></i>
                    Daftar Anggota Aktif
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <input type="text" id="searchInput" class="search-input" placeholder="🔍  Cari nama / NIM...">
                    <button class="export-btn" onclick="exportCSV()">
                        <i class="fas fa-download"></i> Export CSV
                    </button>
                </div>
            </div>

            <?php if (empty($pengurus)): ?>
                <div class="text-center py-5">
                    <div style="font-size:3rem;opacity:0.2;margin-bottom:12px;">👥</div>
                    <div style="font-weight:700;color:#64748b;">Belum ada anggota aktif</div>
                    <div style="font-size:0.82rem;color:#94a3b8;">Terima pendaftar dari menu Seleksi untuk menambahkan anggota.</div>
                    <a href="index.php?action=ormawa_seleksi" class="btn btn-primary rounded-pill mt-3 px-4">
                        <i class="fas fa-user-check me-2"></i>Ke Halaman Seleksi
                    </a>
                </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="modern-table" id="anggotaTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Anggota</th>
                            <th>Jabatan</th>
                            <th>Divisi</th>
                            <th>Jurusan</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="anggotaTbody">
                        <?php foreach ($pengurus as $i => $p):
                            $foto = !empty($p['foto_profil']) ? 'assets/images/profil/' . $p['foto_profil'] : null;
                            $fotoOk = $foto && file_exists($foto);
                            $inisial = strtoupper(substr($p['nama_lengkap'], 0, 1));
                        ?>
                        <tr class="anggota-row" data-name="<?php echo strtolower($p['nama_lengkap']); ?>" data-nim="<?php echo $p['nim']; ?>">
                            <td style="color:#94a3b8;font-size:0.8rem;"><?php echo $i + 1; ?></td>
                            <td>
                                <div class="member-cell">
                                    <?php if ($fotoOk): ?>
                                        <img src="<?php echo htmlspecialchars($foto); ?>" class="member-ava">
                                    <?php else: ?>
                                        <div class="member-ava-fallback"><?php echo $inisial; ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="name-bold"><?php echo htmlspecialchars($p['nama_lengkap']); ?></div>
                                        <div class="nim-muted"><?php echo htmlspecialchars($p['nim']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="background:#eff6ff;color:#2563eb;font-size:0.75rem;font-weight:700;padding:4px 12px;border-radius:999px;">
                                    <?php echo htmlspecialchars($p['nama_jabatan'] ?? '-'); ?>
                                </span>
                            </td>
                            <td style="font-size:0.85rem;color:#334155;"><?php echo htmlspecialchars($p['nama_divisi'] ?? '-'); ?></td>
                            <td style="font-size:0.82rem;color:#64748b;"><?php echo htmlspecialchars($p['jurusan'] ?? '-'); ?></td>
                            <td style="font-size:0.8rem;color:#64748b;">
                                <?php echo !empty($p['periode_mulai']) ? date('d M Y', strtotime($p['periode_mulai'])) : '-'; ?>
                            </td>
                            <td>
                                <span style="background:#dcfce7;color:#15803d;font-size:0.72rem;font-weight:700;padding:3px 10px;border-radius:999px;">
                                    ✅ Aktif
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn-xs edit-jab" title="Edit Jabatan"
                                        onclick="editJabatan(<?php echo $p['kepengurusan_id'] ?? 0; ?>, '<?php echo addslashes($p['nama_lengkap']); ?>', '<?php echo addslashes($p['nama_jabatan']??''); ?>')">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn-xs nope" title="Keluarkan"
                                        onclick="keluarkan(<?php echo $p['kepengurusan_id'] ?? 0; ?>, '<?php echo addslashes($p['nama_lengkap']); ?>')">
                                        <i class="fas fa-user-minus"></i>
                                    </button>
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

<!-- Modal Edit Jabatan -->
<div class="modal fade" id="editJabatanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
            <div class="modal-header" style="background:linear-gradient(135deg,#2563eb,#7c3aed);border:none;">
                <h5 class="modal-title fw-bold text-white text-sm"><i class="fas fa-pen me-2"></i>Edit Jabatan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="small text-muted mb-3">Anggota: <strong id="ejNama">-</strong></p>
                <form method="POST" action="index.php?action=ormawa_kelola_anggota">
                    <input type="hidden" name="tipe_aksi" value="edit_jabatan">
                    <input type="hidden" name="kepengurusan_id" id="ejId">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Jabatan Baru</label>
                        <input type="text" name="jabatan_baru" id="ejJabatan" class="form-control" style="border-radius:10px;" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold rounded-pill">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Keluarkan -->
<div class="modal fade" id="keluarkanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
            <div class="modal-body text-center p-4">
                <div style="font-size:2.5rem;margin-bottom:10px;">⚠️</div>
                <h5 class="fw-bold">Keluarkan Anggota?</h5>
                <p class="text-muted small mb-3">Anggota <strong id="kNama">-</strong> akan dikeluarkan dari organisasi.</p>
                <form method="POST" action="index.php?action=ormawa_kelola_anggota">
                    <input type="hidden" name="tipe_aksi" value="keluarkan">
                    <input type="hidden" name="kepengurusan_id" id="kId">
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger fw-bold rounded-pill px-4">Ya, Keluarkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container-custom" id="toastContainer"></div>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<script>
// Search
document.getElementById('searchInput')?.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.anggota-row').forEach(row => {
        const match = row.dataset.name.includes(q) || row.dataset.nim.includes(q);
        row.style.display = match ? '' : 'none';
    });
});

// Edit Jabatan
function editJabatan(id, nama, jabatan) {
    document.getElementById('ejId').value = id;
    document.getElementById('ejNama').textContent = nama;
    document.getElementById('ejJabatan').value = jabatan;
    new bootstrap.Modal(document.getElementById('editJabatanModal')).show();
}

// Keluarkan
function keluarkan(id, nama) {
    document.getElementById('kId').value = id;
    document.getElementById('kNama').textContent = nama;
    new bootstrap.Modal(document.getElementById('keluarkanModal')).show();
}

// Export CSV
function exportCSV() {
    const rows = [['No', 'Nama Lengkap', 'NIM', 'Jabatan', 'Divisi', 'Jurusan']];
    document.querySelectorAll('.anggota-row').forEach((row, i) => {
        const cells = row.querySelectorAll('td');
        rows.push([
            i + 1,
            cells[1]?.querySelector('.name-bold')?.textContent?.trim() ?? '',
            cells[1]?.querySelector('.nim-muted')?.textContent?.trim() ?? '',
            cells[2]?.textContent?.trim() ?? '',
            cells[3]?.textContent?.trim() ?? '',
            cells[4]?.textContent?.trim() ?? '',
        ]);
    });
    const csv = rows.map(r => r.join(',')).join('\n');
    const a = document.createElement('a');
    a.href = 'data:text/csv;charset=utf-8,\uFEFF' + encodeURIComponent(csv);
    a.download = 'data_anggota_<?php echo date("Ymd"); ?>.csv';
    a.click();
}
</script>