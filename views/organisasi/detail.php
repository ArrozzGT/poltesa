<?php include 'views/templates/header.php'; ?>

<?php
// 1. Persiapan Data Banner & Logo
$namaOrg = $organisasi['nama_organisasi'] ?? 'Organisasi Mahasiswa';
$logo = $organisasi['logo'] ?? '';
$jenis = $organisasi['jenis_organisasi'] ?? 'Lainnya';
$statusAktif = $organisasi['status_aktif'] ?? 'active';

// Logic Gambar Logo
$finalLogoSrc = 'https://ui-avatars.com/api/?name=' . urlencode($namaOrg) . '&size=200&background=random';
if (!empty($logo)) {
    if (file_exists('assets/images/profil/' . $logo)) {
        $finalLogoSrc = 'assets/images/profil/' . $logo;
    } elseif (file_exists('assets/images/' . $logo)) {
        $finalLogoSrc = 'assets/images/' . $logo;
    }
}

// Format Tanggal
$tglBerdiri = !empty($organisasi['tanggal_berdiri']) ? date('d F Y', strtotime($organisasi['tanggal_berdiri'])) : '-';

// Logic WhatsApp
$wa_number = $organisasi['no_whatsapp'] ?? '';
$wa_link = '';
$has_wa = false;
if (!empty($wa_number)) {
    $wa_clean = preg_replace('/[^0-9]/', '', $wa_number);
    if (substr($wa_clean, 0, 1) == '0') $wa_clean = '62' . substr($wa_clean, 1);
    $pesan = "Halo Admin " . $namaOrg . ", saya ingin bertanya mengenai organisasi ini.";
    $wa_link = "https://wa.me/" . $wa_clean . "?text=" . urlencode($pesan);
    $has_wa = true;
}

// Logic Cover Banner (Default to generic ormawa cover)
$coverSrc = 'assets/images/background/gedung.jpg'; // pastikan ada fallback image atau gradient
?>

<!-- ==========================================
     HERO BANNER
     ========================================== -->
<div class="hero-org-banner" style="<?php echo empty($kategori['banner']) ? "background-image: url('" . BASE_PATH . "assets/images/background/gedung.jpg');" : "background-image: url('" . BASE_PATH . "assets/images/ormawa/" . htmlspecialchars($kategori['banner']) . "');"; ?>">
    <div class="container h-100 position-relative">
        <div class="hero-org-content d-flex flex-column flex-md-row align-items-center align-items-md-end text-center text-md-start gap-4 pb-4">
            
            <!-- Logo Overlap -->
            <img src="<?php echo htmlspecialchars($finalLogoSrc); ?>" alt="Logo <?php echo $namaOrg; ?>" class="org-detail-logo">
            
            <!-- Headline Info -->
            <div class="text-white flex-grow-1" style="transform: translateY(-10px);">
                <div class="mb-2">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill me-2">
                        <?php echo htmlspecialchars($jenis); ?>
                    </span>
                    <?php if($statusAktif == 'active'): ?>
                        <span class="badge bg-success bg-opacity-25 text-white border border-success rounded-pill px-3 py-1">
                            <i class="fas fa-check-circle me-1"></i>Aktif
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary bg-opacity-25 text-white border border-secondary rounded-pill px-3 py-1">
                            Non-Aktif
                        </span>
                    <?php endif; ?>
                </div>
                <h1 class="fw-900 mb-1" style="font-size: clamp(1.8rem, 4vw, 2.5rem); text-shadow: 0 2px 10px rgba(0,0,0,0.5);"><?php echo htmlspecialchars($namaOrg); ?></h1>
                <p class="mb-0 opacity-75 fw-500">
                    <i class="far fa-calendar-alt me-2"></i> Berdiri sejak: <?php echo $tglBerdiri; ?>
                </p>
            </div>

            <!-- CTA SMART BUTTON -->
            <div class="ms-md-auto mt-3 mt-md-0" style="transform: translateY(-20px);">
                <?php if(!isset($_SESSION['anggota_id']) && !isset($_SESSION['admin_id'])): ?>
                    <!-- Guest -->
                    <a href="index.php?action=login" class="btn btn-light rounded-pill px-4 py-3 fw-bold shadow-lg animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-sign-in-alt me-2 text-primary"></i>Login untuk Mendaftar
                    </a>
                <?php elseif(isset($_SESSION['admin_id'])): ?>
                    <!-- Administrator -->
                    <button class="btn btn-secondary rounded-pill px-4 py-3 fw-bold shadow" disabled>
                        <i class="fas fa-user-shield me-2"></i>Mode Administrator
                    </button>
                <?php else: ?>
                    <!-- Logged in as User -->
                    <?php if($status_pendaftaran == 'belum_daftar'): ?>
                        <a href="index.php?action=daftar_kepengurusan&organisasi_id=<?php echo $organisasi['organisasi_id']; ?>" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-lg animate__animated animate__pulse animate__infinite">
                            <i class="fas fa-pen-nib me-2"></i>Daftar ke Organisasi Ini
                        </a>
                    <?php elseif($status_pendaftaran == 'pending' || $status_pendaftaran == 'interview'): ?>
                        <button class="btn btn-warning rounded-pill px-4 py-3 fw-bold shadow text-dark" style="cursor: default;">
                            <i class="fas fa-hourglass-half me-2"></i>Menunggu Persetujuan
                        </button>
                    <?php elseif($status_pendaftaran == 'approved'): ?>
                        <button class="btn btn-success rounded-pill px-4 py-3 fw-bold shadow" style="cursor: default;">
                            <i class="fas fa-check-circle me-2"></i>Kamu Sudah Bergabung
                        </button>
                    <?php elseif($status_pendaftaran == 'rejected'): ?>
                        <button class="btn btn-danger rounded-pill px-4 py-3 fw-bold shadow" style="cursor: default;">
                            <i class="fas fa-times-circle me-2"></i>Pendaftaran Ditolak
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<!-- ==========================================
     MAIN CONTENT
     ========================================== -->
<div class="container pb-5 mb-5 mt-4">
    <div class="row g-5">
        
        <!-- Kolom Kiri: Sidebar Nav -->
        <div class="col-lg-3 d-none d-lg-block relative-overflow">
            <!-- WRAP SEMUA ISI SIDEBAR DIBALIK STICKY -->
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-2">
                        <h6 class="fw-bold text-muted text-uppercase small mb-3 ms-3 mt-2">Profil Menu</h6>
                        <div class="nav flex-column nav-pills custom-pills" id="v-pills-tab" role="tablist">
                            <button class="nav-link active text-start" data-bs-toggle="pill" data-bs-target="#tab-profil">
                                <i class="fas fa-info-circle w-20 me-2 text-center"></i> Tentang & Visi Misi
                            </button>
                            <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#tab-pengurus">
                                <i class="fas fa-sitemap w-20 me-2 text-center"></i> Struktur Pengurus
                            </button>
                            <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#tab-kegiatan">
                                <i class="fas fa-images w-20 me-2 text-center"></i> Dokumentasi Kegiatan
                            </button>
                            <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#tab-program">
                                <i class="fas fa-tasks w-20 me-2 text-center"></i> Program Kerja
                            </button>
                            <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#tab-info">
                                <i class="fas fa-bullhorn w-20 me-2 text-center"></i> Pengumuman <span class="badge bg-danger ms-2 rounded-pill"><?php echo count($list_pesan); ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Kotak Kontak Cepat -->
                <?php if ($has_wa): ?>
                <div class="card border-0 shadow-sm rounded-4 mt-4 bg-success bg-opacity-10 border border-success">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fab fa-whatsapp fa-3x text-success"></i>
                        </div>
                        <h6 class="fw-bold text-success">Punya Pertanyaan?</h6>
                        <p class="small text-muted mb-3">Hubungi admin pendaftaran via WhatsApp resmi kami.</p>
                        <a href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-success btn-sm rounded-pill w-100 fw-bold shadow-sm">
                            Chat Admin
                        </a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
        
        <!-- Mobile Nav Pills (Scrollable Horizontal) -->
        <div class="col-12 d-lg-none mb-4">
            <ul class="nav nav-pills flex-nowrap overflow-auto custom-mobile-pills pb-2" id="pills-tab-mobile" role="tablist">
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link active rounded-pill px-4" data-bs-toggle="pill" data-bs-target="#tab-profil">Profil</button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link rounded-pill px-4" data-bs-toggle="pill" data-bs-target="#tab-pengurus">Pengurus</button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link rounded-pill px-4" data-bs-toggle="pill" data-bs-target="#tab-kegiatan">Kegiatan</button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link rounded-pill px-4" data-bs-toggle="pill" data-bs-target="#tab-program">Progja</button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link rounded-pill px-4" data-bs-toggle="pill" data-bs-target="#tab-info">Info</button>
                </li>
            </ul>
        </div>

        <!-- Kolom Kanan: Konten Tab -->
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                
                <!-- TAB 1: PROFIL & VISI MISI -->
                <div class="tab-pane fade show active animate__animated animate__fadeIn" id="tab-profil" role="tabpanel">
                    
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Tentang Organisasi</h4>
                            <p class="text-muted" style="line-height: 1.85; font-size: 1rem;">
                                <?php echo nl2br(htmlspecialchars($organisasi['deskripsi'] ?? 'Deskripsi organisasi belum ditambahkan.')); ?>
                            </p>
                            
                            <div class="row g-4 mt-3">
                                <!-- Visi -->
                                <div class="col-md-6">
                                    <div class="bg-transparent rounded-4 p-4 h-100 border border-light shadow-sm relative-overflow">
                                        <div class="position-absolute opacity-10" style="right:-20px; bottom:-20px;">
                                            <i class="fas fa-eye fa-8x text-primary"></i>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 position-relative z-1">
                                            <div class="bg-primarybg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px; background: rgba(37,99,235,0.1);">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <h5 class="fw-bold text-primary mb-0">Visi</h5>
                                        </div>
                                        <p class="mb-0 text-dark opacity-100 position-relative z-1" style="font-size:0.95rem;">
                                            <?php echo nl2br(htmlspecialchars($organisasi['visi'] ?? 'Belum ada visi.')); ?>
                                        </p>
                                    </div>
                                </div>
                                <!-- Misi -->
                                <div class="col-md-6">
                                    <div class="bg-transparent rounded-4 p-4 h-100 border border-light shadow-sm relative-overflow">
                                        <div class="position-absolute opacity-10" style="right:-20px; bottom:-20px;">
                                            <i class="fas fa-bullseye fa-8x text-success"></i>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 position-relative z-1">
                                            <div class="bg-success text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px; background: rgba(16,185,129,0.1);">
                                                <i class="fas fa-bullseye"></i>
                                            </div>
                                            <h5 class="fw-bold text-success mb-0">Misi</h5>
                                        </div>
                                        <div class="mb-0 text-dark opacity-100 position-relative z-1 ps-2" style="font-size:0.95rem;">
                                            <?php 
                                                // Ubah baris baru menjadi list sederhana jika memungkinkan, atau sekadar nl2br
                                                $misi = htmlspecialchars($organisasi['misi'] ?? 'Belum ada misi.');
                                                echo nl2br($misi);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divisi Section inside Profil tab -->
                    <?php if(!empty($divisi)): ?>
                    <h4 class="fw-bold text-dark mb-4 mt-5">Departemen / Divisi</h4>
                    <div class="row g-3">
                        <?php foreach($divisi as $div): ?>
                            <div class="col-md-6">
                                <div class="card border border-light shadow-sm rounded-4 h-100 hover-lift bg-light bg-opacity-50">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0 text-dark"><?php echo htmlspecialchars($div['nama_divisi']); ?></h6>
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1" style="font-size:0.7rem;">
                                                <i class="fas fa-user-friends me-1"></i><?php echo $div['kuota_anggota']; ?> Kuota
                                            </span>
                                        </div>
                                        <p class="small text-muted mb-0 mt-2 line-clamp-3">
                                            <?php echo htmlspecialchars($div['deskripsi_divisi']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- TAB 2: PENGURUS -->
                <div class="tab-pane fade animate__animated animate__fadeIn" id="tab-pengurus" role="tabpanel">
                    
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Struktur Pengurus Inti</h4>
                            
                            <div class="row g-4 justify-content-center mb-5">
                                <?php 
                                $hasInti = false;
                                if(!empty($kepengurusan)):
                                    foreach($kepengurusan as $urus): 
                                        if(in_array($urus['nama_jabatan'], ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'])):
                                            $hasInti = true;
                                            $fotoP = !empty($urus['foto_profil']) ? 'assets/images/profil/' . $urus['foto_profil'] : null;
                                            $srcP = ($fotoP && file_exists($fotoP)) ? $fotoP : 'https://ui-avatars.com/api/?name='.urlencode($urus['nama_lengkap']).'&background=random';
                                            
                                            // Tentukan warna border avatar berdasar jabatan
                                            $borderColor = '#2563eb'; // default blue
                                            if($urus['nama_jabatan'] == 'Ketua') $borderColor = '#f59e0b'; // gold
                                            if($urus['nama_jabatan'] == 'Wakil Ketua') $borderColor = '#10b981'; // green
                                ?>
                                <div class="col-6 col-md-4 col-lg-3 text-center">
                                    <div class="card h-100 border-0 py-3 hover-lift bg-transparent">
                                        <div class="card-body p-2 d-flex flex-column align-items-center">
                                            <div class="position-relative mb-3">
                                                <img src="<?php echo $srcP; ?>" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid <?php echo $borderColor; ?>; padding:2px;">
                                                <?php if($urus['nama_jabatan'] == 'Ketua'): ?>
                                                    <div class="position-absolute top-0 start-50 translate-middle" style="margin-top:-5px;">
                                                        <i class="fas fa-crown text-warning fs-5" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <h6 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($urus['nama_lengkap']); ?></h6>
                                            <span class="badge rounded-pill fw-500" style="background: color-mix(in srgb, <?php echo $borderColor; ?> 15%, transparent); color: <?php echo $borderColor; ?>;">
                                                <?php echo htmlspecialchars($urus['nama_jabatan']); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; endforeach; endif; ?>
                                
                                <?php if(!$hasInti): ?>
                                    <div class="col-12 text-center py-5">
                                        <i class="fas fa-users-slash fa-3x text-muted opacity-25 mb-3"></i>
                                        <h6 class="text-muted">Data pengurus inti belum dipublikasikan.</h6>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- TAB 3: KEGIATAN -->
                <div class="tab-pane fade animate__animated animate__fadeIn" id="tab-kegiatan" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h4 class="fw-bold text-dark mb-0">Galeri Kegiatan</h4>
                                <span class="badge bg-primary rounded-pill"><?php echo count($kegiatan ?? []); ?> Dokumentasi</span>
                            </div>

                            <?php if (!empty($kegiatan)): ?>
                                <div class="row g-4">
                                    <?php foreach ($kegiatan as $idx => $foto): 
                                        $imgFile = 'assets/images/kegiatan/' . $foto['foto_kegiatan'];
                                        $imgSrc = file_exists($imgFile) ? $imgFile : 'https://via.placeholder.com/600x400?text=No+Photo';
                                    ?>
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-card group">
                                                <div class="position-relative overflow-hidden" style="height:220px;">
                                                    <img src="<?php echo $imgSrc; ?>" class="w-100 h-100 object-fit-cover transition-transform duration-300" style="transition: transform 0.5s;" alt="Kegiatan" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                    <div class="position-absolute align-items-center justify-content-between w-100 d-flex p-3 top-0 start-0 z-2 bg-gradient-to-b from-dark-50">
                                                        <span class="badge bg-dark bg-opacity-75 backdrop-blur rounded-pill">
                                                            <i class="far fa-calendar me-1"></i> <?php echo date('d M Y', strtotime($foto['tanggal_kegiatan'])); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="card-body px-4 py-3">
                                                    <h6 class="fw-bold mb-2 text-dark line-clamp-1" title="<?php echo htmlspecialchars($foto['nama_kegiatan']); ?>"><?php echo htmlspecialchars($foto['nama_kegiatan']); ?></h6>
                                                    <p class="small text-muted mb-0 line-clamp-2"><?php echo htmlspecialchars($foto['deskripsi'] ?? 'Deskripsi tidak btersedia.'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                                        <i class="far fa-images fa-2x text-muted opacity-50"></i>
                                    </div>
                                    <h6 class="text-muted fw-bold">Belum Ada Dokumentasi Kegiatan</h6>
                                    <p class="small text-muted">Organisasi belum mengunggah foto kegiatan apapun.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: PROGRAM KERJA -->
                <div class="tab-pane fade animate__animated animate__fadeIn" id="tab-program" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Program Kerja Unggulan</h4>
                            
                            <?php if(!empty($list_progja)): ?>
                                <div class="progja-timeline position-relative mt-4 ms-3 w-100 pb-3" style="border-left: 2px dashed var(--border-color);">
                                    <?php foreach($list_progja as $prog): ?>
                                    <div class="timeline-item position-relative ps-4 ms-1 mb-5">
                                        <!-- Dot marker -->
                                        <div class="position-absolute bg-white border border-primary border-3 rounded-circle" style="width: 16px; height: 16px; left:-10px; top:4px;"></div>
                                        
                                        <!-- Content -->
                                        <div class="bg-light rounded-4 p-4 border shadow-sm">
                                            <div class="d-flex align-items-center mb-2 gap-2">
                                                <span class="badge bg-primary text-white rounded-pill px-3 py-1">
                                                    <i class="far fa-clock me-1"></i> <?php echo htmlspecialchars($prog['target_waktu']); ?>
                                                </span>
                                            </div>
                                            <h5 class="fw-bold mb-2 text-dark"><?php echo htmlspecialchars($prog['nama_program']); ?></h5>
                                            <p class="text-muted mb-0" style="line-height:1.6;"><?php echo htmlspecialchars($prog['deskripsi']); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-tasks fa-3x text-muted opacity-25 mb-3"></i>
                                    <h6 class="text-muted fw-bold">Belum Ada Program Kerja</h6>
                                    <p class="small text-muted">Agenda kerja organisasi ini belum diunggah.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: PENGUMUMAN -->
                <div class="tab-pane fade animate__animated animate__fadeIn" id="tab-info" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Papan Pengumuman</h4>
                            
                            <?php if(!empty($list_pesan)): ?>
                                <div class="list-group list-group-flush gap-3">
                                    <?php foreach($list_pesan as $pesan): ?>
                                    <div class="list-group-item border rounded-4 p-4 shadow-sm bg-white hover-lift">
                                        <div class="d-flex w-100 justify-content-between align-items-start mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                    <i class="fas fa-bullhorn"></i>
                                                </div>
                                                <h5 class="mb-0 fw-bold text-dark">
                                                    <?php echo htmlspecialchars($pesan['judul']); ?>
                                                </h5>
                                            </div>
                                            <span class="badge bg-light text-muted border px-2 py-1 flex-shrink-0 ms-2">
                                                <i class="far fa-clock me-1"></i><?php echo date('d M Y, H:i', strtotime($pesan['tanggal_kirim'])); ?>
                                            </span>
                                        </div>
                                        <div class="text-dark opacity-75 ms-5 ps-2" style="white-space: pre-line; line-height: 1.7;">
                                            <?php echo htmlspecialchars($pesan['isi_pesan']); ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                                        <i class="fas fa-bell-slash fa-2x text-muted opacity-50"></i>
                                    </div>
                                    <h6 class="text-muted fw-bold">Tidak Ada Pengumuman</h6>
                                    <p class="small text-muted">Belum ada pengumuman terbaru untuk ditampilkan.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Inline CSS Khusus Profile -->
<style>
.relative-overflow { position: relative; overflow: hidden; }
.w-20 { width: 20px; display: inline-block; }
.custom-pills .nav-link {
    color: var(--text-secondary);
    border-radius: 12px;
    padding: 12px 16px;
    font-weight: 600;
    margin-bottom: 5px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.custom-pills .nav-link:hover {
    background: var(--bg-muted);
    color: var(--primary);
}
.custom-pills .nav-link.active {
    background: var(--primary-xlight);
    color: var(--primary);
    border-color: rgba(37,99,235,0.2);
    box-shadow: none;
}

/* Float WA */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 30px;
    right: 30px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50%;
    text-align: center;
    font-size: 30px;
    box-shadow: 0 4px 15px rgba(37,211,102,0.4);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: pulse-wa 2s infinite;
}
.whatsapp-float:hover {
    background-color: #128C7E;
    transform: scale(1.15) rotate(-10deg);
    color: white;
}
@keyframes pulse-wa {
    0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
    100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
}

/* Mobile Tabs Scrollable */
.custom-mobile-pills::-webkit-scrollbar { display: none; }
.custom-mobile-pills { scrollbar-width: none; border-bottom: 1px solid var(--border-color); margin-bottom: 1rem; }
.custom-mobile-pills .nav-link {
    white-space: nowrap;
    color: var(--text-secondary);
    font-weight: 500;
    border: 1px solid transparent;
}
.custom-mobile-pills .nav-link.active {
    background: var(--primary);
    color: white;
    box-shadow: 0 4px 10px rgba(37,99,235,0.2);
}

/* Dark mode adjust */
[data-theme="dark"] .bg-white { background: var(--bg-card) !important; }
[data-theme="dark"] .bg-light { background: var(--bg-muted) !important; }
[data-theme="dark"] .text-dark { color: var(--text-primary) !important; }
</style>

<?php include 'views/templates/footer.php'; ?>