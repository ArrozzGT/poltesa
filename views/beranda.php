<?php include 'views/templates/header.php'; ?>

<!-- ================================================================
     HERO SECTION
     ================================================================ -->
<section class="hero-section position-relative overflow-hidden">

    <!-- Background layers -->
    <div class="hero-bg-gradient"></div>
    <div class="hero-bg-pattern"></div>
    <div class="hero-bg-glow hero-glow-1"></div>
    <div class="hero-bg-glow hero-glow-2"></div>

    <!-- Floating decorative shapes -->
    <div class="hero-shape hero-shape-1 float-anim"><i class="fas fa-university"></i></div>
    <div class="hero-shape hero-shape-2 float-anim" style="animation-delay:1.2s;"><i class="fas fa-users"></i></div>
    <div class="hero-shape hero-shape-3 float-anim" style="animation-delay:0.6s;"><i class="fas fa-star"></i></div>

    <div class="container position-relative" style="z-index:10;">
        <div class="row align-items-center min-vh-hero">
            <div class="col-lg-7 col-xl-6 text-white">

                <!-- Badge -->
                <div class="hero-badge animate__animated animate__fadeInDown" style="animation-delay:.1s;">
                    <i class="fas fa-bolt me-2"></i>
                    Portal Resmi Ormawa Politeknik Negeri Sambas
                </div>

                <!-- Heading -->
                <h1 class="hero-title animate__animated animate__fadeInUp" style="animation-delay:.25s;">
                    Temukan
                    <span class="hero-highlight d-block">Organisasimu</span>
                    di Polnes
                </h1>

                <!-- Sub -->
                <p class="hero-sub animate__animated animate__fadeInUp" style="animation-delay:.4s;">
                    Satu platform untuk mengeksplorasi, mendaftar, dan berkembang
                    bersama puluhan organisasi mahasiswa terbaik di Politeknik Negeri Sambas.
                </p>

                <!-- CTA Buttons -->
                <div class="hero-cta d-flex flex-wrap gap-3 animate__animated animate__fadeInUp" style="animation-delay:.55s;">
                    <a href="#section-organisasi" class="btn btn-hero-primary">
                        <i class="fas fa-compass me-2"></i>Jelajahi Organisasi
                    </a>
                    <?php if (!isset($_SESSION['anggota_id']) && !isset($_SESSION['admin_id'])): ?>
                    <a href="index.php?action=register" class="btn btn-hero-outline">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <?php else: ?>
                    <a href="index.php?action=dashboard" class="btn btn-hero-outline">
                        <i class="fas fa-tachometer-alt me-2"></i>Buka Dashboard
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Scroll hint -->
                <div class="hero-scroll-hint animate__animated animate__fadeIn" style="animation-delay:1.2s;">
                    <i class="fas fa-chevron-down"></i>
                </div>

            </div>

            <!-- Hero Illustration Column -->
            <div class="col-lg-5 col-xl-6 d-none d-lg-flex justify-content-center align-items-center">
                <div class="hero-illustration animate__animated animate__fadeInRight" style="animation-delay:.4s;">
                    <!-- SVG Illustration -->
                    <svg viewBox="0 0 480 380" xmlns="http://www.w3.org/2000/svg" class="hero-svg">
                        <!-- Building base -->
                        <rect x="80" y="180" width="320" height="160" rx="8" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>
                        <!-- Building windows row 1 -->
                        <rect x="110" y="210" width="40" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <rect x="170" y="210" width="40" height="30" rx="4" fill="rgba(255,215,0,0.5)"/>
                        <rect x="230" y="210" width="40" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <rect x="290" y="210" width="40" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <rect x="350" y="210" width="30" height="30" rx="4" fill="rgba(255,215,0,0.3)"/>
                        <!-- Building windows row 2 -->
                        <rect x="110" y="265" width="40" height="30" rx="4" fill="rgba(255,215,0,0.4)"/>
                        <rect x="170" y="265" width="40" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <rect x="230" y="265" width="40" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <rect x="290" y="265" width="40" height="30" rx="4" fill="rgba(255,215,0,0.45)"/>
                        <rect x="350" y="265" width="30" height="30" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <!-- Door -->
                        <rect x="210" y="300" width="60" height="40" rx="4" fill="rgba(255,255,255,0.25)" stroke="rgba(255,255,255,0.35)" stroke-width="1"/>
                        <!-- Roof / Pillars top -->
                        <rect x="60" y="155" width="360" height="30" rx="6" fill="rgba(255,255,255,0.18)" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                        <!-- Flag / Pole -->
                        <line x1="240" y1="60" x2="240" y2="155" stroke="rgba(255,255,255,0.6)" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M240 60 L280 78 L240 96 Z" fill="rgba(255,215,0,0.8)"/>
                        <!-- Floating cards -->
                        <rect x="10" y="100" width="110" height="55" rx="10" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                        <circle cx="30" cy="125" r="10" fill="rgba(255,215,0,0.7)"/>
                        <rect x="50" y="116" width="55" height="7" rx="3" fill="rgba(255,255,255,0.65)"/>
                        <rect x="50" y="128" width="38" height="5" rx="2" fill="rgba(255,255,255,0.35)"/>
                        <rect x="360" y="90" width="110" height="55" rx="10" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                        <circle cx="380" cy="115" r="10" fill="rgba(16,185,129,0.8)"/>
                        <rect x="400" y="106" width="55" height="7" rx="3" fill="rgba(255,255,255,0.65)"/>
                        <rect x="400" y="118" width="40" height="5" rx="2" fill="rgba(255,255,255,0.35)"/>
                        <!-- People silhouettes -->
                        <circle cx="160" cy="345" r="10" fill="rgba(255,255,255,0.35)"/>
                        <path d="M150 360 Q160 350 170 360 L172 375 H148 Z" fill="rgba(255,255,255,0.25)"/>
                        <circle cx="240" cy="345" r="10" fill="rgba(255,215,0,0.6)"/>
                        <path d="M230 360 Q240 350 250 360 L252 375 H228 Z" fill="rgba(255,215,0,0.4)"/>
                        <circle cx="320" cy="345" r="10" fill="rgba(255,255,255,0.35)"/>
                        <path d="M310 360 Q320 350 330 360 L332 375 H308 Z" fill="rgba(255,255,255,0.25)"/>
                        <!-- Stars -->
                        <circle cx="50"  cy="50"  r="2.5" fill="rgba(255,255,255,0.5)"/>
                        <circle cx="420" cy="40"  r="2"   fill="rgba(255,255,255,0.4)"/>
                        <circle cx="400" cy="170" r="2"   fill="rgba(255,255,255,0.3)"/>
                        <circle cx="30"  cy="200" r="2"   fill="rgba(255,255,255,0.3)"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom wave -->
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C360,80 720,0 1080,50 C1260,70 1380,30 1440,40 L1440,80 L0,80 Z"
                  fill="var(--bg-body)"/>
        </svg>
    </div>
</section>


<!-- ================================================================
     STATS SECTION
     ================================================================ -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <!-- Stat 1 -->
            <div class="col-lg-4 col-md-4 col-sm-6 reveal">
                <div class="stat-card">
                    <div class="stat-icon" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="stat-body">
                        <div class="stat-number">
                            <span data-counter="<?php echo isset($total_organisasi) ? (int)$total_organisasi : 0; ?>">0</span>
                        </div>
                        <div class="stat-label">Organisasi Aktif</div>
                        <div class="stat-sub">UKM, HIMA, BEM & lainnya</div>
                    </div>
                    <div class="stat-badge" style="background:#dbeafe;color:#1d4ed8;">
                        <i class="fas fa-arrow-up me-1"></i>Aktif
                    </div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="col-lg-4 col-md-4 col-sm-6 reveal reveal-delay-1">
                <div class="stat-card">
                    <div class="stat-icon" style="background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-body">
                        <div class="stat-number">
                            <span data-counter="<?php echo isset($total_anggota) ? (int)$total_anggota : 0; ?>">0</span>
                        </div>
                        <div class="stat-label">Mahasiswa Bergabung</div>
                        <div class="stat-sub">Dari seluruh prodi</div>
                    </div>
                    <div class="stat-badge" style="background:#d1fae5;color:#065f46;">
                        <i class="fas fa-users me-1"></i>Member
                    </div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="col-lg-4 col-md-4 col-sm-6 reveal reveal-delay-2">
                <div class="stat-card">
                    <div class="stat-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-body">
                        <div class="stat-number">
                            <?php echo date('Y'); ?>
                        </div>
                        <div class="stat-label">Periode Aktif</div>
                        <div class="stat-sub">Tahun akademik berjalan</div>
                    </div>
                    <div class="stat-badge" style="background:#fef3c7;color:#92400e;">
                        <i class="fas fa-star me-1"></i>Current
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ================================================================
     HOW IT WORKS — ALUR PENDAFTARAN
     ================================================================ -->
<section class="steps-section py-5">
    <div class="container py-3">

        <div class="text-center mb-5 reveal">
            <div class="section-label">
                <i class="fas fa-route me-1"></i>Alur Pendaftaran
            </div>
            <h2 class="section-title">Bergabung dalam <span class="text-gradient">4 Langkah Mudah</span></h2>
            <p class="section-sub">Proses yang cepat dan transparan untuk semua mahasiswa Polnes.</p>
        </div>

        <!-- Steps connector line (desktop only) -->
        <div class="steps-row position-relative">
            <div class="steps-connector d-none d-lg-block"></div>
            <div class="row g-4 position-relative">

                <div class="col-lg-3 col-md-6 reveal">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <div class="step-icon-wrap" style="--step-color:#2563eb;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h5 class="step-title">Buat Akun</h5>
                        <p class="step-desc">Daftarkan diri dengan NIM dan email aktif kampus Polnes.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 reveal reveal-delay-1">
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <div class="step-icon-wrap" style="--step-color:#7c3aed;">
                            <i class="fas fa-search"></i>
                        </div>
                        <h5 class="step-title">Pilih Organisasi</h5>
                        <p class="step-desc">Jelajahi profil UKM & HIMA, temukan yang sesuai minatmu.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 reveal reveal-delay-2">
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <div class="step-icon-wrap" style="--step-color:#f59e0b;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5 class="step-title">Daftar & Seleksi</h5>
                        <p class="step-desc">Isi formulir pendaftaran, ikuti seleksi dan wawancara.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 reveal reveal-delay-3">
                    <div class="step-card">
                        <div class="step-number">✓</div>
                        <div class="step-icon-wrap" style="--step-color:#10b981;">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h5 class="step-title">Resmi Bergabung</h5>
                        <p class="step-desc">Cek status di dashboard dan mulai berkarya bersama!</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


<!-- ================================================================
     FEATURED ORGANISASI SECTION
     ================================================================ -->
<section id="section-organisasi" class="orgs-section py-5">
    <div class="container py-3">

        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
            <div class="reveal">
                <div class="section-label">
                    <i class="fas fa-university me-1"></i>Organisasi
                </div>
                <h2 class="section-title mb-0">Jelajahi <span class="text-gradient">Organisasi Kami</span></h2>
            </div>
            <!-- Search -->
            <div class="search-wrap reveal reveal-delay-1">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text"
                           id="searchOrgInput"
                           class="search-input"
                           placeholder="Cari nama atau kategori..."
                           autocomplete="off">
                </div>
            </div>
        </div>

        <!-- Org Grid -->
        <div class="row g-4" id="organisasi-grid">
            <?php if (empty($organisations)): ?>
                <!-- Empty state -->
                <div class="col-12 reveal">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h5 class="empty-state-title">Belum Ada Organisasi</h5>
                        <p class="empty-state-desc">Organisasi akan tampil di sini setelah ditambahkan oleh admin.</p>
                    </div>
                </div>
            <?php else: ?>
                <?php
                $Category_colors = [
                    'UKM'   => ['bg'=>'#dbeafe','text'=>'#1d4ed8'],
                    'HIMA'  => ['bg'=>'#d1fae5','text'=>'#065f46'],
                    'BEM'   => ['bg'=>'#fce7f3','text'=>'#9d174d'],
                    'UPM'   => ['bg'=>'#fef3c7','text'=>'#92400e'],
                    'UKMK'  => ['bg'=>'#ede9fe','text'=>'#5b21b6'],
                ];
                $default_color  = ['bg'=>'#f0f4ff','text'=>'#2563eb'];

                foreach ($organisations as $index => $org):
                    $logoFile     = $org['logo'] ?? '';
                    $finalLogoSrc = null;
                    if (!empty($logoFile) && file_exists('assets/images/profil/' . $logoFile)) {
                        $finalLogoSrc = 'assets/images/profil/' . $logoFile;
                    } elseif (!empty($logoFile) && file_exists('assets/images/' . $logoFile)) {
                        $finalLogoSrc = 'assets/images/' . $logoFile;
                    }
                    $jenis    = $org['jenis_organisasi'] ?? 'Organisasi';
                    $color    = $Category_colors[$jenis] ?? $default_color;
                    $delay_cl = 'reveal-delay-' . min($index % 4, 4);
                ?>
                <div class="col-xl-4 col-md-6 org-item reveal <?php echo $delay_cl; ?>"
                     data-nama="<?php echo strtolower(htmlspecialchars($org['nama_organisasi'])); ?>"
                     data-kategori="<?php echo strtolower(htmlspecialchars($jenis)); ?>">

                    <div class="org-card">
                        <!-- Card top accent bar -->
                        <div class="org-card-bar" style="background:linear-gradient(90deg,<?php echo $color['text']; ?>,<?php echo $color['bg']; ?>);"></div>

                        <!-- Card header: logo + badge -->
                        <div class="org-card-head">
                            <div class="org-logo-wrap">
                                <?php if ($finalLogoSrc): ?>
                                    <img src="<?php echo htmlspecialchars($finalLogoSrc); ?>"
                                         alt="Logo <?php echo htmlspecialchars($org['nama_organisasi']); ?>"
                                         class="org-logo-img">
                                <?php else: ?>
                                    <div class="org-logo-placeholder" style="background:<?php echo $color['bg']; ?>;color:<?php echo $color['text']; ?>">
                                        <?php echo strtoupper(substr($org['nama_organisasi'], 0, 2)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <span class="org-badge" style="background:<?php echo $color['bg']; ?>;color:<?php echo $color['text']; ?>">
                                <?php echo htmlspecialchars($jenis); ?>
                            </span>
                        </div>

                        <!-- Card body -->
                        <div class="org-card-body">
                            <h5 class="org-name">
                                <?php echo htmlspecialchars($org['nama_organisasi']); ?>
                            </h5>
                            <p class="org-desc">
                                <?php echo htmlspecialchars($org['deskripsi'] ?? 'Deskripsi belum tersedia.'); ?>
                            </p>
                        </div>

                        <!-- Card footer -->
                        <div class="org-card-footer">
                            <?php if (!empty($org['jumlah_anggota'])): ?>
                            <div class="org-meta">
                                <i class="fas fa-users me-1"></i>
                                <?php echo (int)$org['jumlah_anggota']; ?> anggota
                            </div>
                            <?php endif; ?>
                            <a href="index.php?action=detail&id=<?php echo $org['organisasi_id']; ?>"
                               class="org-btn">
                                Lihat Profil <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- No results -->
        <div id="noResultsMsg" class="empty-state mt-4" style="display:none;">
            <div class="empty-state-icon"><i class="fas fa-search"></i></div>
            <h5 class="empty-state-title">Tidak Ditemukan</h5>
            <p class="empty-state-desc">Coba kata kunci lain atau <a href="#" onclick="document.getElementById('searchOrgInput').value='';filterOrgs();return false;">reset pencarian</a>.</p>
        </div>

        <!-- View All Button -->
        <?php if (!empty($organisations)): ?>
        <div class="text-center mt-5 reveal">
            <a href="index.php?action=organisasi" class="btn btn-view-all">
                <i class="fas fa-th-large me-2"></i>Lihat Semua Organisasi
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        <?php endif; ?>

    </div>
</section>


<!-- ================================================================
     CTA SECTION
     ================================================================ -->
<section class="cta-section position-relative overflow-hidden">
    <div class="cta-bg-pattern"></div>
    <div class="cta-glow"></div>

    <div class="container position-relative py-5" style="z-index:5;">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white reveal">

                <div class="section-label d-inline-flex mb-3"
                     style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                </div>

                <h2 class="cta-title">
                    Siap Mengembangkan<br>
                    <span style="color:#fbbf24;">Potensi Dirimu?</span>
                </h2>

                <p class="cta-desc">
                    Bergabunglah dengan ratusan mahasiswa yang telah aktif berorganisasi.
                    Asah kepemimpinan, bangun jaringan, dan ukir prestasi di Polnes.
                </p>

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php if (!isset($_SESSION['anggota_id']) && !isset($_SESSION['admin_id'])): ?>
                    <a href="index.php?action=register" class="btn btn-cta-primary">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="index.php?action=login" class="btn btn-cta-outline">
                        <i class="fas fa-sign-in-alt me-2"></i>Sudah Punya Akun?
                    </a>
                    <?php else: ?>
                    <a href="index.php?action=organisasi" class="btn btn-cta-primary">
                        <i class="fas fa-search me-2"></i>Cari Organisasi
                    </a>
                    <?php if(isset($_SESSION['anggota_id'])): ?>
                    <a href="index.php?action=dashboard" class="btn btn-cta-outline">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Saya
                    </a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Trust badges -->
                <div class="cta-badges d-flex flex-wrap justify-content-center gap-4 mt-5">
                    <div class="cta-badge-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Data Aman</span>
                    </div>
                    <div class="cta-badge-item">
                        <i class="fas fa-bolt"></i>
                        <span>Proses Cepat</span>
                    </div>
                    <div class="cta-badge-item">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Mobile Friendly</span>
                    </div>
                    <div class="cta-badge-item">
                        <i class="fas fa-clock"></i>
                        <span>24/7 Akses</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Page-specific Script -->
<script>
function filterOrgs() {
    const val       = (document.getElementById('searchOrgInput')?.value || '').toLowerCase();
    const items     = document.querySelectorAll('.org-item');
    const noResults = document.getElementById('noResultsMsg');
    let   found     = 0;

    items.forEach(item => {
        const nama     = item.dataset.nama     || '';
        const kategori = item.dataset.kategori || '';
        const match    = nama.includes(val) || kategori.includes(val);

        item.style.display = match ? '' : 'none';
        if (match) found++;
    });

    if (noResults) noResults.style.display = (found === 0 && val) ? 'flex' : 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchOrgInput');
    if (search) {
        search.addEventListener('input', filterOrgs);
    }
});
</script>


<!-- Page-specific Styles -->
<style>
/* ---------------------------------------------------------------
   HERO
--------------------------------------------------------------- */
.hero-section {
    min-height: 92vh;
    display: flex;
    align-items: center;
    position: relative;
    padding: 80px 0 60px;
}

.min-vh-hero {
    min-height: 70vh;
    padding: 40px 0;
}

.hero-bg-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #1e40af 0%, #2563eb 45%, #3b82f6 75%, #1d4ed8 100%);
}

.hero-bg-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.04) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.06) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.hero-bg-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.hero-glow-1 {
    width: 400px; height: 400px;
    background: rgba(124,58,237,0.25);
    top: -80px; right: 100px;
}
.hero-glow-2 {
    width: 300px; height: 300px;
    background: rgba(6,182,212,0.15);
    bottom: 80px; left: 50px;
}

/* Floating shapes */
.hero-shape {
    position: absolute;
    border-radius: 16px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    color: rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 2;
}
.hero-shape-1 { width:56px;height:56px;font-size:1.4rem; top:15%;left:4%; }
.hero-shape-2 { width:48px;height:48px;font-size:1.2rem; bottom:25%;right:3%; }
.hero-shape-3 { width:40px;height:40px;font-size:1rem;   top:60%;left:48%; }

/* Badge */
.hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: rgba(255,255,255,0.9);
    border-radius: 999px;
    padding: 6px 18px;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 1.2rem;
    backdrop-filter: blur(10px);
}

/* Title */
.hero-title {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    margin-bottom: 1.2rem;
}

.hero-highlight {
    background: linear-gradient(90deg, #fbbf24, #fde68a, #fbbf24);
    background-size: 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 3s ease infinite;
}
@keyframes gradientShift {
    0%, 100% { background-position: 0%; }
    50%       { background-position: 100%; }
}

.hero-sub {
    font-size: 1.05rem;
    color: rgba(255,255,255,0.82);
    line-height: 1.75;
    max-width: 520px;
    margin-bottom: 2rem;
}

/* CTA Buttons */
.btn-hero-primary {
    background: #fff;
    color: var(--primary);
    font-weight: 700;
    font-size: 0.95rem;
    padding: 13px 30px;
    border-radius: 999px;
    border: none;
    transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
.btn-hero-primary:hover {
    color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.2);
}

.btn-hero-outline {
    background: rgba(255,255,255,0.12);
    color: #fff;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 12px 28px;
    border-radius: 999px;
    border: 1.5px solid rgba(255,255,255,0.45);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
.btn-hero-outline:hover {
    background: rgba(255,255,255,0.22);
    color: #fff;
    transform: translateY(-2px);
}

/* Scroll hint */
.hero-scroll-hint {
    margin-top: 3rem;
    color: rgba(255,255,255,0.5);
    font-size: 1.1rem;
    animation: bounceDown 1.8s ease-in-out infinite;
}
@keyframes bounceDown {
    0%, 100% { transform: translateY(0); opacity:.5; }
    50%       { transform: translateY(8px); opacity:1; }
}

/* Illustration */
.hero-illustration { position: relative; }
.hero-svg { width: 100%; max-width: 480px; height: auto; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.2)); }

/* Wave separator */
.hero-wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}
.hero-wave svg { display: block; width: 100%; height: 80px; }

/* ---------------------------------------------------------------
   STATS
--------------------------------------------------------------- */
.stats-section { background: var(--bg-body); }

.stat-card {
    background: var(--bg-card);
    border-radius: var(--radius-xl);
    padding: 1.8rem;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-smooth);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: var(--radius-xl) var(--radius-xl) 0 0;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.stat-number {
    font-size: 2.4rem;
    font-weight: 800;
    line-height: 1;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--text-primary);
    margin-top: 4px;
}

.stat-sub {
    font-size: 0.78rem;
    color: var(--text-muted);
}

.stat-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    align-self: flex-start;
    margin-top: auto;
}

/* ---------------------------------------------------------------
   STEPS
--------------------------------------------------------------- */
.steps-section { background: var(--bg-muted); }

.section-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
}
.section-sub {
    color: var(--text-muted);
    font-size: 0.95rem;
    max-width: 500px;
    margin: 0 auto;
}

.steps-connector {
    position: absolute;
    top: 45px;
    left: calc(12.5% + 20px);
    right: calc(12.5% + 20px);
    height: 2px;
    background: linear-gradient(90deg, #2563eb, #7c3aed, #f59e0b, #10b981);
    z-index: 0;
    border-radius: 2px;
    opacity: 0.3;
}

.step-card {
    background: var(--bg-card);
    border-radius: var(--radius-xl);
    padding: 2rem 1.5rem 1.5rem;
    border: 1px solid var(--border-color);
    text-align: center;
    position: relative;
    transition: var(--transition-smooth);
    height: 100%;
    z-index: 1;
}
.step-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-xlight);
}

.step-number {
    position: absolute;
    top: -14px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--gradient-primary);
    color: #fff;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.72rem;
    font-weight: 800;
    border: 3px solid var(--bg-muted);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

.step-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 20px;
    background: color-mix(in srgb, var(--step-color) 10%, transparent);
    color: var(--step-color, #2563eb);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0.5rem auto 1rem;
    border: 2px solid color-mix(in srgb, var(--step-color) 20%, transparent);
    transition: var(--transition-smooth);
}
.step-card:hover .step-icon-wrap {
    background: var(--step-color, #2563eb);
    color: #fff;
    transform: rotate(-5deg) scale(1.1);
}

.step-title {
    font-weight: 700;
    font-size: 1rem;
    color: var(--text-primary);
    margin-bottom: 0.4rem;
}
.step-desc {
    font-size: 0.83rem;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0;
}

/* ---------------------------------------------------------------
   ORGS SECTION
--------------------------------------------------------------- */
.orgs-section { background: var(--bg-body); }

/* Search */
.search-wrap {}
.search-input-group {
    position: relative;
    display: flex;
    align-items: center;
}
.search-icon {
    position: absolute;
    left: 14px;
    color: var(--text-muted);
    font-size: 0.85rem;
    pointer-events: none;
}
.search-input {
    background: var(--bg-card);
    border: 1.5px solid var(--border-color);
    border-radius: 999px;
    padding: 10px 20px 10px 38px;
    font-size: 0.875rem;
    color: var(--text-primary);
    width: 260px;
    transition: var(--transition-base);
    font-family: 'Poppins', sans-serif;
}
.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
    width: 300px;
}
.search-input::placeholder { color: var(--text-muted); }

@media (max-width:576px) {
    .search-input { width: 100%; }
    .search-input:focus { width: 100%; }
}

/* Org Card */
.org-card {
    background: var(--bg-card);
    border-radius: var(--radius-xl);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition-smooth);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}
.org-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(37,99,235,0.15);
    border-color: rgba(37,99,235,0.2);
}

.org-card-bar {
    height: 4px;
    width: 100%;
    flex-shrink: 0;
}

.org-card-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1.2rem 1.2rem 0.5rem;
    gap: 8px;
}

.org-logo-wrap {
    flex-shrink: 0;
}

.org-logo-img {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: 14px;
    border: 2px solid var(--border-color);
    background: var(--bg-muted);
}

.org-logo-placeholder {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.1rem;
    border: 2px solid transparent;
}

.org-badge {
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 4px;
    white-space: nowrap;
}

.org-card-body {
    padding: 0.75rem 1.2rem;
    flex: 1;
}

.org-name {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.4rem;
    line-height: 1.3;
}

.org-desc {
    font-size: 0.82rem;
    color: var(--text-muted);
    line-height: 1.65;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin: 0;
}

.org-card-footer {
    padding: 0.75rem 1.2rem 1.2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    border-top: 1px solid var(--border-color);
}

.org-meta {
    font-size: 0.78rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
}

.org-btn {
    display: inline-flex;
    align-items: center;
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
    gap: 4px;
    transition: var(--transition-base);
    padding: 6px 14px;
    border-radius: 999px;
    border: 1.5px solid var(--primary-xlight);
    background: var(--primary-xlight);
    white-space: nowrap;
}
.org-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

/* View all button */
.btn-view-all {
    background: var(--bg-card);
    color: var(--primary);
    border: 2px solid var(--primary-xlight);
    border-radius: 999px;
    padding: 13px 36px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: var(--transition-smooth);
    box-shadow: var(--shadow-sm);
}
.btn-view-all:hover {
    background: var(--gradient-primary);
    color: #fff;
    border-color: transparent;
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* Empty state */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 4rem 2rem;
    background: var(--bg-card);
    border-radius: var(--radius-xl);
    border: 1px dashed var(--border-color);
}
.empty-state-icon {
    width: 72px; height: 72px;
    background: var(--bg-muted);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
}
.empty-state-title {
    font-weight: 700;
    color: var(--text-secondary);
    margin-bottom: 0.4rem;
}
.empty-state-desc {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin: 0;
}

/* ---------------------------------------------------------------
   CTA SECTION
--------------------------------------------------------------- */
.cta-section {
    background: linear-gradient(135deg, #1e40af 0%, #2563eb 40%, #1d4ed8 70%, #312e81 100%);
    padding: 80px 0;
}
.cta-bg-pattern {
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.cta-glow {
    position: absolute;
    width: 500px; height: 500px;
    background: rgba(124,58,237,0.2);
    border-radius: 50%;
    top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    filter: blur(80px);
    pointer-events: none;
}
.cta-title {
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.25;
    margin-bottom: 1rem;
}
.cta-desc {
    font-size: 1rem;
    color: rgba(255,255,255,0.78);
    max-width: 520px;
    margin: 0 auto 2rem;
    line-height: 1.8;
}
.btn-cta-primary {
    background: #fff;
    color: var(--primary);
    font-weight: 700;
    padding: 13px 32px;
    border-radius: 999px;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    display: inline-flex;
    align-items: center;
}
.btn-cta-primary:hover {
    color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.2);
}
.btn-cta-outline {
    background: transparent;
    color: #fff;
    font-weight: 600;
    padding: 12px 28px;
    border-radius: 999px;
    border: 1.5px solid rgba(255,255,255,0.45);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}
.btn-cta-outline:hover {
    background: rgba(255,255,255,0.12);
    color: #fff;
    transform: translateY(-2px);
}
.cta-badges { margin-top: 2rem; }
.cta-badge-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.7);
    font-size: 0.82rem;
    font-weight: 500;
}
.cta-badge-item i { color: #fbbf24; font-size: 0.9rem; }

/* ---------------------------------------------------------------
   DARK MODE ADJUSTMENTS
--------------------------------------------------------------- */
[data-theme="dark"] .step-card,
[data-theme="dark"] .stat-card,
[data-theme="dark"] .org-card {
    background: var(--bg-card);
    border-color: var(--border-color);
}

[data-theme="dark"] .steps-section { background: #0f172a; }
[data-theme="dark"] .hero-wave svg path { fill: #0f172a; }

[data-theme="dark"] .search-input {
    background: var(--bg-card);
    border-color: var(--border-color);
    color: var(--text-primary);
}

[data-theme="dark"] .btn-view-all {
    background: var(--bg-card);
    border-color: var(--border-color);
}

[data-theme="dark"] .step-number {
    border-color: #0f172a;
}
</style>

<?php include 'views/templates/footer.php'; ?>