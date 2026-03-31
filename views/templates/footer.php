</main><!-- /main -->

<!-- ===== FOOTER ===== -->
<footer class="mt-auto pt-5">
    <div class="container pt-4 pb-2">
        <div class="row g-5">

            <!-- Col 1: Brand & Info -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:44px;height:44px;background:var(--gradient-primary);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;flex-shrink:0;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <div style="font-size:1.1rem;font-weight:800;color:#fff;line-height:1.1;">ORMAWA</div>
                        <div style="font-size:0.7rem;color:rgba(255,255,255,0.55);letter-spacing:0.5px;text-transform:uppercase;">Politeknik Negeri Sambas</div>
                    </div>
                </div>
                <p class="small mb-4" style="color:rgba(255,255,255,0.55);line-height:1.8;">
                    Sistem Informasi Organisasi Mahasiswa Politeknik Negeri Sambas. Wadah aspirasi dan kegiatan mahasiswa yang terintegrasi.
                </p>
                <ul class="list-unstyled small mb-4" style="color:rgba(255,255,255,0.55);">
                    <li class="mb-2 d-flex align-items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1" style="color:var(--accent-yellow);flex-shrink:0;"></i>
                        <span>Kawasan Pendidikan Tinggi, Jl. Sejangkung, Sebayan, Sambas, Kalimantan Barat 79463</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="fas fa-phone" style="color:var(--accent-yellow);flex-shrink:0;"></i>
                        <span>(0562) 6303000</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="fas fa-envelope" style="color:var(--accent-yellow);flex-shrink:0;"></i>
                        <a href="mailto:info@poltesa.ac.id" style="color:rgba(255,255,255,0.55);">info@poltesa.ac.id</a>
                    </li>
                </ul>
                <!-- Social Media -->
                <div class="d-flex gap-2">
                    <a href="#" class="footer-social" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="footer-social" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer-social" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="footer-social" title="Twitter/X">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Menu Cepat -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="footer-heading">Menu</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="index.php">Beranda</a></li>
                    <li class="mb-2"><a href="index.php?action=organisasi">Daftar Ormawa</a></li>
                    <li class="mb-2"><a href="index.php?action=login">Login Mahasiswa</a></li>
                    <li class="mb-2"><a href="index.php?action=register">Daftar Akun</a></li>
                </ul>
            </div>

            <!-- Col 3: Layanan -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="footer-heading">Layanan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#">Pendaftaran Online</a></li>
                    <li class="mb-2"><a href="#">Program Kerja</a></li>
                    <li class="mb-2"><a href="#">Galeri Kegiatan</a></li>
                    <li class="mb-2"><a href="#">Laporan Kinerja</a></li>
                </ul>
            </div>

            <!-- Col 4: Peta -->
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-heading">Lokasi Kampus</h6>
                <div class="rounded-3 overflow-hidden border" style="height:180px;border-color:rgba(255,255,255,0.1)!important;">
                    <iframe
                        width="100%"
                        height="100%"
                        frameborder="0"
                        scrolling="no"
                        src="https://maps.google.com/maps?q=Politeknik%20Negeri%20Sambas&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        style="border:0;filter:grayscale(20%);"
                        allowfullscreen
                        aria-hidden="false"
                        loading="lazy"
                        tabindex="0">
                    </iframe>
                </div>
                <a href="https://maps.google.com/?q=Politeknik+Negeri+Sambas"
                   target="_blank"
                   class="d-inline-flex align-items-center gap-1 mt-2 small"
                   style="color:var(--accent-yellow);">
                    <i class="fas fa-external-link-alt"></i>
                    Buka di Google Maps
                </a>
            </div>

        </div><!-- /row -->

        <!-- Bottom bar -->
        <div class="row pt-4 mt-2" style="border-top:1px solid rgba(255,255,255,0.08);">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <small style="color:rgba(255,255,255,0.35);">
                    &copy; <?php echo date('Y'); ?> <strong style="color:rgba(255,255,255,0.55);">Politeknik Negeri Sambas</strong>. All Rights Reserved.
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <small style="color:rgba(255,255,255,0.3);">
                    Dibangun dengan <i class="fas fa-heart" style="color:#ef4444;"></i> oleh Tim IT POLTESA
                </small>
            </div>
        </div>

    </div><!-- /container -->
</footer>

<!-- Toast Notification Container -->
<div id="toast-container"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SINORA Global JS -->
<script src="<?php echo $base_path; ?>assets/js/script.js?v=<?php echo time(); ?>"></script>

<style>
/* Footer Social Icons */
.footer-social {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.65);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.25s ease;
}
.footer-social:hover {
    background: var(--gradient-primary);
    border-color: transparent;
    color: #fff;
    transform: translateY(-3px);
}

.footer-heading {
    color: #fff;
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 1rem;
    position: relative;
    padding-bottom: 8px;
}
.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 28px;
    height: 2px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

footer a {
    transition: all 0.2s ease;
}
footer a:not(.footer-social):hover {
    color: var(--accent-yellow) !important;
    padding-left: 4px;
}
</style>

</body>
</html>