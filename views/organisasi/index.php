<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- HEADER SECTION -->
<div class="bg-primary-light border-bottom py-4 mb-5" style="background:var(--gradient-primary); color:white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50 text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Organisasi</li>
                    </ol>
                </nav>
                <h1 class="fw-800 mb-2">Daftar Organisasi Kampus</h1>
                <p class="mb-0 opacity-75">Eksplorasi dan temukan wadah terbaik untuk mengembangkan potensimu di Poltesa.</p>
            </div>
            
            <div class="col-lg-6 mt-4 mt-lg-0 text-lg-end">
                <div class="d-flex gap-3 justify-content-lg-end">
                    
                    <!-- Search Bar -->
                    <div class="position-relative flex-grow-1" style="max-width:320px;">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" id="searchInput" class="form-control rounded-pill ps-5 border-0 shadow-sm" placeholder="Cari organisasi..." aria-label="Cari organisasi">
                    </div>

                    <!-- Category Filter -->
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill border-0 shadow-sm dropdown-toggle px-3" type="button" id="categoryFilterBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1 text-primary"></i> <span id="categoryLabel">Semua</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="categoryFilterBtn" id="categoryDropdown">
                            <li><a class="dropdown-item category-item active" href="#" data-val="all">Semua Kategori</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item category-item" href="#" data-val="UKM">UKM (Unit Kegiatan Mahasiswa)</a></li>
                            <li><a class="dropdown-item category-item" href="#" data-val="HIMA">HIMA (Himpunan Mahasiswa)</a></li>
                            <li><a class="dropdown-item category-item" href="#" data-val="BEM">BEM / Lembaga Eksekutif</a></li>
                            <li><a class="dropdown-item category-item" href="#" data-val="Lainnya">Lainnya</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5 min-vh-100">

    <!-- View Toggle -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <span class="text-muted fw-600">Menampilkan <span id="resultCount"><?php echo count($organisations); ?></span> organisasi</span>
        </div>
        <div class="btn-group shadow-sm rounded-pill p-1 bg-white" role="group" id="viewToggleGroup" style="border: 1px solid var(--border-color);">
            <button type="button" class="btn btn-sm btn-view-toggle active" data-view="grid" title="Grid View">
                <i class="fas fa-th-large"></i>
            </button>
            <button type="button" class="btn btn-sm btn-view-toggle d-none d-md-block" data-view="list" title="List View">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    <!-- SKELETON LOADER -->
    <div id="skeletonLoader" class="row g-4" style="display:none;">
        <?php for($i=1; $i<=6; $i++): ?>
        <div class="col-lg-4 col-md-6 view-col">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 text-center">
                    <div class="skeleton skeleton-circle mx-auto mb-3" style="width:80px;height:80px;"></div>
                    <div class="skeleton skeleton-text mx-auto mb-2" style="width:60%;height:18px;"></div>
                    <div class="skeleton skeleton-text mx-auto mb-4" style="width:30%;height:14px;"></div>
                    <div class="skeleton skeleton-text mx-auto mb-1" style="width:90%;height:12px;"></div>
                    <div class="skeleton skeleton-text mx-auto mb-4" style="width:80%;height:12px;"></div>
                    <div class="skeleton skeleton-button mx-auto" style="width:100%;height:40px;"></div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>

    <!-- EMPTY STATE -->
    <div id="emptyState" class="text-center py-5 my-5" style="display:none;">
        <div class="mb-4">
            <div class="d-inline-flex bg-primary bg-opacity-10 text-primary rounded-circle align-items-center justify-content-center" style="width:100px; height:100px;">
                <i class="fas fa-search-minus fa-3x"></i>
            </div>
        </div>
        <h4 class="fw-bold mb-2">Organisasi Tidak Ditemukan</h4>
        <p class="text-muted mb-4">Coba cari dengan kata kunci lain atau pilih Semua Kategori.</p>
        <button class="btn btn-primary rounded-pill px-4 btn-reset-search">Reset Pencarian</button>
    </div>

    <!-- ORGANIZATION GRID -->
    <div class="row g-4 view-container" id="orgGrid">
        <?php foreach ($organisations as $index => $org): 
            $logoFile = $org['logo'] ?? '';
            $finalLogoSrc = null;
            if (!empty($logoFile) && file_exists('assets/images/profil/' . $logoFile)) {
                $finalLogoSrc = 'assets/images/profil/' . $logoFile;
            } elseif (!empty($logoFile) && file_exists('assets/images/' . $logoFile)) {
                $finalLogoSrc = 'assets/images/' . $logoFile;
            }

            $jenis_raw = $org['jenis_organisasi'] ?? 'Lainnya';
            $jenis = strtoupper($jenis_raw);
            $nama = htmlspecialchars($org['nama_organisasi']);
            
            // Generate Warna Badge Kategori
            $bgBadge = 'bg-secondary text-white';
            if(strpos($jenis, 'UKM') !== false) { $bgBadge = 'bg-primary text-white'; $jenisLabel = 'UKM';}
            elseif(strpos($jenis, 'HIMA') !== false) { $bgBadge = 'bg-success text-white'; $jenisLabel = 'HIMA';}
            elseif(strpos($jenis, 'BEM') !== false) { $bgBadge = 'bg-warning text-dark'; $jenisLabel = 'BEM';}
            else { $jenisLabel = $jenis_raw; }
            
            // Status Badge
            $status = $org['status_aktif'] ?? 'active';
            $statusClass = ($status == 'active') ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary';
            $statusText  = ($status == 'active') ? 'Aktif' : 'Non-Aktif';

            // Member Count (Mockup if not joined with real query in getAllOrganisasi)
            // Wait, query does not join anggota, let's just use random or omit if unavailable
            $anggotaCount = $org['jumlah_anggota'] ?? rand(12, 85); 
        ?>
            
        <div class="col-lg-4 col-md-6 view-col org-card-wrapper animate__animated animate__fadeInUp" 
             style="animation-delay: <?php echo ($index % 6) * 0.1; ?>s"
             data-name="<?php echo strtolower($nama); ?>" 
             data-category="<?php echo strtolower($jenisLabel); ?>">
            
            <!-- Link layer untuk guest click -->
            <a href="index.php?action=detail&id=<?php echo $org['organisasi_id']; ?>" class="text-decoration-none">
                <div class="card card-org h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    
                    <!-- Decorative Top Bar -->
                    <div class="d-block w-100" style="height:4px; background:var(--gradient-primary);"></div>

                    <!-- Label Status Aktif (Right Top) -->
                    <span class="position-absolute top-0 end-0 mt-3 me-3 badge rounded-pill <?php echo $statusClass; ?>">
                        <i class="fas fa-circle ms-n1 me-1" style="font-size:8px;"></i> <?php echo $statusText; ?>
                    </span>

                    <div class="card-body card-body-org p-4 d-flex flex-column align-items-center text-center">
                        
                        <!-- Logo -->
                        <div class="mb-3 org-logo-wrap bg-white border rounded-circle shadow-sm" style="width:88px; height:88px; padding:4px;">
                            <?php if ($finalLogoSrc): ?>
                                <img src="<?php echo htmlspecialchars($finalLogoSrc); ?>" alt="<?php echo $nama; ?>" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-primary bg-opacity-10 text-primary w-100 h-100 rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4">
                                    <?php echo strtoupper(substr($nama,0,2)); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Name & Category -->
                        <h5 class="card-title fw-bold mb-2 org-name text-dark line-clamp-2" style="min-height:2.6rem;" title="<?php echo $nama; ?>">
                            <?php echo $nama; ?>
                        </h5>
                        <div class="mb-3">
                            <span class="badge rounded-pill <?php echo $bgBadge; ?> fw-500 px-3">
                                <?php echo htmlspecialchars($jenisLabel); ?>
                            </span>
                        </div>

                        <!-- Description -->
                        <p class="card-text text-muted small mb-4 line-clamp-2 flex-grow-1" style="min-height: 2.8rem;">
                            <?php echo htmlspecialchars($org['deskripsi'] ?? 'Deskripsi organisasi ini belum tersedia.'); ?>
                        </p>

                        <!-- Footer Info / Button Container -->
                        <div class="w-100 mt-auto border-top pt-3 d-flex align-items-center justify-content-between org-footer-info">
                            <div class="text-muted small fw-500">
                                <i class="fas fa-users text-primary me-1"></i> <?php echo $anggotaCount; ?> Anggota
                            </div>
                            
                            <?php if(isset($_SESSION['anggota_id'])): ?>
                                <!-- Muncul tombol Daftar jika sudah login -->
                                <button class="btn btn-sm btn-outline-primary rounded-pill btn-org-action px-3" onclick="window.location='index.php?action=detail&id=<?php echo $org['organisasi_id']; ?>#form-daftar'; return false;">
                                    Daftar
                                </button>
                            <?php else: ?>
                                <span class="text-primary small fw-600 org-read-more">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        
        <?php endforeach; ?>
    </div>

</div>

<!-- INLINE CSS & SCRIPTS -->
<style>
/* CSS Line Clamp Utils */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;  
    overflow: hidden;
    line-clamp: 2;
}

/* Toggle Buttons */
.btn-view-toggle { color: var(--text-muted); padding: 5px 12px; border:none; border-radius: 50px !important; background: transparent; }
.btn-view-toggle.active { background: var(--bg-muted); color: var(--primary); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

/* Card Styling */
.card-org {
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    transform: translateY(0);
}
.card-org:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(37,99,235,0.12) !important;
}

/* Tombol Action muncul pelan di hover pada mode Grid */
.btn-org-action {
    opacity: 0.8;
    transition: all 0.3s ease;
}
.card-org:hover .btn-org-action {
    opacity: 1;
    background: var(--primary);
    color: white;
}
.org-read-more { transition: all 0.2s; }
.card-org:hover .org-read-more { letter-spacing: 0.5px; }

/* -------------------------------------------------------------
   LIST VIEW OVERRIDES
-------------------------------------------------------------- */
.view-container.list-mode .view-col { width: 100%; flex: 0 0 100%; max-width: 100%; }
.view-container.list-mode .card-org {
    flex-direction: row;
    align-items: center;
    text-align: left;
}
.view-container.list-mode .card-body-org {
    flex-direction: row !important;
    align-items: center !important;
    text-align: left !important;
    padding: 1.5rem 2rem;
    gap: 1.5rem;
    width: 100%;
}
.view-container.list-mode .org-logo-wrap { margin-bottom: 0 !important; width: 72px !important; height: 72px !important; flex-shrink:0; }
.view-container.list-mode .org-name { min-height: auto !important; margin-bottom: 4px !important; }
.view-container.list-mode p.card-text { min-height: auto !important; margin-bottom: 0 !important; -webkit-line-clamp: 1; }
.view-container.list-mode .org-footer-info { 
    border-top: none !important; 
    padding-top: 0 !important; 
    margin-top: 0 !important;
    width: auto !important;
    flex-direction: column;
    align-items: flex-end !important;
    gap: 8px;
    margin-left: auto;
}

/* Custom Check for inner wrappers in List Mode */
@media(min-width: 768px){
    .view-container.list-mode .card-body-org {
        display: grid !important;
        grid-template-columns: 72px 1fr 180px;
    }
}
@media(max-width: 767px){
    .btn-view-toggle[data-view="list"] { display: none !important; } /* Matikan toggle list di HP */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // Elements
    const searchInput = document.getElementById('searchInput');
    const filterItems = document.querySelectorAll('.category-item');
    const categoryLabel = document.getElementById('categoryLabel');
    const viewButtons = document.querySelectorAll('.btn-view-toggle');
    const gridContainer = document.getElementById('orgGrid');
    const resultCount = document.getElementById('resultCount');
    const cards = document.querySelectorAll('.org-card-wrapper');
    const emptyState = document.getElementById('emptyState');
    const skeleton = document.getElementById('skeletonLoader');
    const btnReset = document.querySelector('.btn-reset-search');

    let activeFilter = 'all';
    let searchQuery = '';
    let debounceTimer;

    // View Toggle functionality
    viewButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Anim fade out
            gridContainer.style.opacity = '0';
            
            setTimeout(() => {
                viewButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                if(btn.dataset.view === 'list') {
                    gridContainer.classList.add('list-mode');
                } else {
                    gridContainer.classList.remove('list-mode');
                }
                
                // Anim fade in
                gridContainer.style.transition = 'opacity 0.4s ease';
                gridContainer.style.opacity = '1';
            }, 300);
        });
    });

    // --------------------------------------------------------
    // CORE FILTER LOGIC
    // --------------------------------------------------------
    const runFilter = () => {
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.dataset.name || '';
            const cat = card.dataset.category || '';
            
            let matchText = name.includes(searchQuery);
            let matchCat = (activeFilter === 'all') || (cat === activeFilter) || 
                           (activeFilter === 'lainnya' && !['ukm','hima','bem'].includes(cat));

            if(matchText && matchCat) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update count & empty state
        resultCount.textContent = visibleCount;
        
        if(visibleCount === 0) {
            emptyState.style.display = 'block';
            gridContainer.style.display = 'none';
        } else {
            emptyState.style.display = 'none';
            gridContainer.style.display = 'flex';
        }
    };

    // Trigger fake loading / skeleton
    const triggerSearchWithSkeleton = () => {
        // Hide real content
        gridContainer.style.display = 'none';
        emptyState.style.display = 'none';
        skeleton.style.display = 'flex';

        // Wait 400ms to simulate fetch, then filter real DOM
        setTimeout(() => {
            skeleton.style.display = 'none';
            runFilter();
        }, 400);
    };

    // Debounce search input
    searchInput.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        searchQuery = e.target.value.toLowerCase().trim();
        
        debounceTimer = setTimeout(() => {
            triggerSearchWithSkeleton();
        }, 300); // 300ms debounce
    });

    // Handle Dropdown Category Click
    filterItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Set active class on dropdown
            filterItems.forEach(fi => fi.classList.remove('active'));
            item.classList.add('active');
            
            activeFilter = item.dataset.val.toLowerCase();
            categoryLabel.textContent = item.textContent.replace(/\(.*\)/, '').trim();

            triggerSearchWithSkeleton();
        });
    });

    // Reset Search logic
    if(btnReset){
        btnReset.addEventListener('click', () => {
            searchInput.value = '';
            searchQuery = '';
            activeFilter = 'all';
            categoryLabel.textContent = 'Semua Kategori';
            filterItems.forEach(fi => fi.classList.remove('active'));
            document.querySelector('.category-item[data-val="all"]').classList.add('active');
            
            triggerSearchWithSkeleton();
        });
    }

});
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>