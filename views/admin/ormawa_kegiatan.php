<?php include __DIR__ . '/../templates/header.php'; ?>
<?php
if (!isset($organisasi)) $organisasi = ['nama_organisasi' => $_SESSION['nama_lengkap'] ?? 'Organisasi', 'jenis_organisasi' => 'UKM', 'logo' => ''];
?>

<style>
.admin-wrap{display:flex;min-height:calc(100vh - 80px);background:#f0f4ff;}
.admin-sidebar{width:270px;flex-shrink:0;background:linear-gradient(180deg,#1e40af,#1d4ed8 40%,#2563eb);padding:0;position:sticky;top:72px;height:calc(100vh - 72px);overflow-y:auto;display:flex;flex-direction:column;box-shadow:4px 0 20px rgba(37,99,235,0.15);scrollbar-width:none;}
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
.admin-main{flex:1;padding:28px 32px;}

/* Layout Grid */
.kegiatan-grid{display:grid;grid-template-columns:340px 1fr;gap:24px;align-items:start;}

/* Add Form Card */
.add-card{background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,0.06);overflow:hidden;position:sticky;top:20px;}
.add-card-header{background:linear-gradient(135deg,#2563eb,#7c3aed);padding:18px 22px;color:#fff;}
.add-card-header h6{font-weight:700;margin:0;font-size:0.95rem;}
.add-card-body{padding:22px;}

.form-label-sm{font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;display:block;}
.form-ctrl{width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.87rem;outline:none;transition:border-color 0.2s;color:#334155;}
.form-ctrl:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,0.1);}

/* Drop Zone */
.drop-zone{border:2px dashed #cbd5e1;border-radius:12px;padding:20px;text-align:center;cursor:pointer;transition:all 0.2s;background:#f8fafc;}
.drop-zone:hover,.drop-zone.drag-over{border-color:#2563eb;background:#eff6ff;}
#previewImg{width:100%;border-radius:10px;margin-top:10px;display:none;max-height:160px;object-fit:cover;}

/* Gallery */
.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;}
.gallery-card{background:#fff;border-radius:16px;box-shadow:0 2px 10px rgba(0,0,0,0.06);overflow:hidden;transition:transform 0.2s,box-shadow 0.2s;}
.gallery-card:hover{transform:translateY(-4px);box-shadow:0 10px 25px rgba(0,0,0,0.1);}
.gallery-img-wrap{position:relative;height:150px;overflow:hidden;}
.gallery-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform 0.3s;}
.gallery-card:hover .gallery-img-wrap img{transform:scale(1.05);}
.gallery-date-badge{position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.6);color:#fff;font-size:0.7rem;font-weight:700;padding:3px 10px;border-radius:20px;backdrop-filter:blur(4px);}
.gallery-info{padding:14px;}
.gallery-name{font-weight:700;font-size:0.88rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:4px;}
.gallery-desc{font-size:0.78rem;color:#94a3b8;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:12px;}
.gallery-del-btn{width:100%;border:none;background:#fee2e2;color:#b91c1c;border-radius:8px;padding:7px;font-size:0.78rem;font-weight:700;cursor:pointer;transition:background 0.2s;}
.gallery-del-btn:hover{background:#fecaca;}

.panel-wrap{background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,0.05);overflow:hidden;}
.panel-header{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid #f1f5f9;}
.panel-title{font-weight:700;font-size:0.95rem;color:#1e293b;}

.toast-container-custom{position:fixed;top:20px;right:20px;z-index:9999;}
.toast-custom{background:#fff;border-radius:12px;padding:14px 18px;box-shadow:0 10px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:12px;min-width:280px;animation:slideToast 0.3s ease;border-left:4px solid #10b981;margin-bottom:10px;}
@keyframes slideToast{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}

@media(max-width:992px){
    .admin-wrap{flex-direction:column;}
    .admin-sidebar{width:100%;height:auto;position:static;flex-direction:row;overflow-x:auto;}
    .sidebar-org-header,.sidebar-section-label{display:none;}
    .sidebar-nav{display:flex;flex-direction:row;padding:8px;white-space:nowrap;}
    .sidebar-link{flex-direction:row;flex-shrink:0;margin-bottom:0;margin-right:4px;padding:8px 14px;}
    .kegiatan-grid{grid-template-columns:1fr;}
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
        $cur = $_GET['action'] ?? 'ormawa_kegiatan';
        $orgName = $organisasi['nama_organisasi'] ?? '-';
        ?>
        <div class="sidebar-org-header">
            <div class="d-flex align-items-center gap-3">
                <div class="sidebar-logo-wrap"><?php if ($logoSrc): ?><img src="<?php echo htmlspecialchars($logoSrc); ?>" alt=""><?php else: ?><i class="fas fa-university" style="color:#fff;font-size:1.4rem;"></i><?php endif; ?></div>
                <div>
                    <div class="sidebar-org-name"><?php echo htmlspecialchars($orgName); ?></div>
                    <span class="sidebar-org-badge"><?php echo htmlspecialchars($organisasi['jenis_organisasi'] ?? 'UKM'); ?></span>
                </div>
            </div>
        </div>
        <div class="sidebar-nav">
            <div class="sidebar-section-label">Menu Utama</div>
            <a href="index.php?action=ormawa_dashboard" class="sidebar-link"><span class="link-icon"><i class="fas fa-tachometer-alt"></i></span>Dashboard</a>
            <div class="sidebar-section-label">Manajemen</div>
            <a href="index.php?action=ormawa_seleksi" class="sidebar-link"><span class="link-icon"><i class="fas fa-user-check"></i></span>Seleksi Anggota</a>
            <a href="index.php?action=ormawa_kelola_anggota" class="sidebar-link"><span class="link-icon"><i class="fas fa-users"></i></span>Kelola Anggota</a>
            <a href="index.php?action=ormawa_kelola_divisi" class="sidebar-link"><span class="link-icon"><i class="fas fa-sitemap"></i></span>Kelola Divisi</a>
            <div class="sidebar-section-label">Konten</div>
            <a href="index.php?action=ormawa_kegiatan" class="sidebar-link active"><span class="link-icon"><i class="fas fa-camera"></i></span>Kegiatan</a>
            <a href="index.php?action=ormawa_progja" class="sidebar-link"><span class="link-icon"><i class="fas fa-tasks"></i></span>Program Kerja</a>
            <a href="index.php?action=ormawa_laporan" class="sidebar-link"><span class="link-icon"><i class="fas fa-file-alt"></i></span>Laporan</a>
            <a href="index.php?action=ormawa_pesan" class="sidebar-link"><span class="link-icon"><i class="fas fa-bullhorn"></i></span>Broadcast</a>
            <div class="sidebar-section-label">Organisasi</div>
            <a href="index.php?action=ormawa_edit_profil" class="sidebar-link"><span class="link-icon"><i class="fas fa-edit"></i></span>Edit Profil Org</a>
            <a href="index.php?action=organisasi" class="sidebar-link"><span class="link-icon"><i class="fas fa-globe"></i></span>Lihat Portal</a>
        </div>
        <div class="sidebar-footer">
            <a href="index.php?action=logout" class="sidebar-logout-btn" onclick="return confirm('Yakin logout?')"><i class="fas fa-sign-out-alt"></i>Logout Sistem</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="admin-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin:0;">Kelola Kegiatan</h1>
                <p style="font-size:0.85rem;color:#64748b;margin:0;"><?php echo count($list_kegiatan ?? []); ?> kegiatan terdokumentasi</p>
            </div>
            <a href="index.php?action=ormawa_dashboard" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                <i class="fas fa-arrow-left me-2"></i>Dashboard
            </a>
        </div>

        <div class="kegiatan-grid">
            <!-- Add Form -->
            <div class="add-card">
                <div class="add-card-header">
                    <h6><i class="fas fa-plus-circle me-2"></i>Tambah Dokumentasi Kegiatan</h6>
                </div>
                <div class="add-card-body">
                    <form method="POST" action="index.php?action=ormawa_kegiatan" enctype="multipart/form-data" id="addForm">
                        <div class="mb-3">
                            <label class="form-label-sm">Nama Kegiatan <span style="color:#ef4444;">*</span></label>
                            <input type="text" name="nama_kegiatan" class="form-ctrl" placeholder="Contoh: Bakti Sosial 2025" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-sm">Tanggal Pelaksanaan <span style="color:#ef4444;">*</span></label>
                            <input type="date" name="tanggal" class="form-ctrl" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-sm">Deskripsi</label>
                            <textarea name="deskripsi" class="form-ctrl" rows="3" placeholder="Ceritakan kegiatan ini..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-sm">Foto Dokumentasi <span style="color:#ef4444;">*</span></label>
                            <div class="drop-zone" id="dropZone" onclick="document.getElementById('fotoInput').click()">
                                <i class="fas fa-cloud-upload-alt fa-2x" style="color:#94a3b8;margin-bottom:8px;"></i>
                                <div style="font-size:0.82rem;color:#64748b;font-weight:600;">Klik atau seret foto ke sini</div>
                                <div style="font-size:0.72rem;color:#94a3b8;margin-top:4px;">JPG/PNG, maks 5MB</div>
                                <img id="previewImg" src="" alt="Preview">
                            </div>
                            <input type="file" name="foto" id="fotoInput" accept="image/*" style="display:none;" required onchange="previewFoto(this)">
                        </div>
                        <button type="submit" name="tambah_kegiatan" class="btn btn-primary fw-bold w-100 rounded-pill py-2">
                            <i class="fas fa-upload me-2"></i>Upload Kegiatan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Gallery -->
            <div>
                <div class="panel-wrap mb-0">
                    <div class="panel-header">
                        <div class="panel-title"><i class="fas fa-images me-2 text-primary"></i>Galeri Kegiatan</div>
                        <span style="font-size:0.8rem;color:#94a3b8;"><?php echo count($list_kegiatan ?? []); ?> foto</span>
                    </div>
                    <div class="p-4">
                        <?php if (empty($list_kegiatan)): ?>
                            <div class="text-center py-5">
                                <div style="font-size:3rem;opacity:0.2;margin-bottom:12px;">📸</div>
                                <div style="font-weight:700;color:#64748b;">Belum ada dokumentasi</div>
                                <div style="font-size:0.82rem;color:#94a3b8;">Gunakan form di sebelah kiri untuk menambahkan foto.</div>
                            </div>
                        <?php else: ?>
                            <div class="gallery-grid">
                                <?php foreach ($list_kegiatan as $k): ?>
                                <div class="gallery-card">
                                    <div class="gallery-img-wrap">
                                        <img src="assets/images/kegiatan/<?php echo htmlspecialchars($k['foto_kegiatan']); ?>"
                                             alt="<?php echo htmlspecialchars($k['nama_kegiatan']); ?>"
                                             onerror="this.src='https://placehold.co/400x300/eff6ff/2563eb?text=No+Image'">
                                        <span class="gallery-date-badge">
                                            <i class="far fa-calendar me-1"></i><?php echo date('d M Y', strtotime($k['tanggal_kegiatan'])); ?>
                                        </span>
                                    </div>
                                    <div class="gallery-info">
                                        <div class="gallery-name"><?php echo htmlspecialchars($k['nama_kegiatan']); ?></div>
                                        <div class="gallery-desc"><?php echo htmlspecialchars($k['deskripsi'] ?? '-'); ?></div>
                                        <button class="gallery-del-btn" onclick="hapusKegiatan(<?php echo $k['kegiatan_id']; ?>, '<?php echo addslashes($k['nama_kegiatan']); ?>')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal Hapus Konfirmasi -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
            <div class="modal-body text-center p-4">
                <div style="font-size:2.5rem;margin-bottom:10px;">🗑️</div>
                <h5 class="fw-bold">Hapus Kegiatan?</h5>
                <p class="text-muted small mb-4">Foto kegiatan "<strong id="hapusNama">-</strong>" akan dihapus permanen.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="hapusLink" class="btn btn-danger fw-bold rounded-pill px-4">Ya, Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container-custom" id="toastContainer"></div>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<script>
// Preview foto
function previewFoto(input) {
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
        document.getElementById('dropZone').style.borderColor = '#2563eb';
        document.getElementById('dropZone').style.background = '#eff6ff';
    }
}

// Drag & Drop
const dz = document.getElementById('dropZone');
if (dz) {
    dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
    dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
    dz.addEventListener('drop', e => {
        e.preventDefault(); dz.classList.remove('drag-over');
        const fi = document.getElementById('fotoInput');
        fi.files = e.dataTransfer.files;
        previewFoto(fi);
    });
}

// Konfirmasi hapus
function hapusKegiatan(id, nama) {
    document.getElementById('hapusNama').textContent = nama;
    document.getElementById('hapusLink').href = 'index.php?action=ormawa_kegiatan&hapus_id=' + id;
    new bootstrap.Modal(document.getElementById('hapusModal')).show();
}

// Toast
<?php if (isset($_GET['status']) && $_GET['status'] === 'sukses'): ?>
(function() {
    const c = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = 'toast-custom';
    t.innerHTML = '<i class="fas fa-check-circle text-success" style="font-size:1.3rem;"></i><div><strong>Berhasil!</strong><br><span style="font-size:0.82rem;color:#64748b;">Dokumentasi kegiatan tersimpan.</span></div>';
    c.appendChild(t);
    setTimeout(() => t.remove(), 3500);
})();
<?php endif; ?>
</script>