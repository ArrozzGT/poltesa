/**
 * ORMAWA POLTESA — Global JavaScript
 * Sistem Informasi Organisasi Mahasiswa
 */

/* ============================================================
   1. DARK MODE
   ============================================================ */
const SinoraTheme = (function () {
    const STORAGE_KEY = 'sinora_theme';
    const DARK        = 'dark';
    const LIGHT       = 'light';

    function getPreference() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) return saved;
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? DARK : LIGHT;
    }

    function apply(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(STORAGE_KEY, theme);
        updateToggleIcon(theme);
    }

    function updateToggleIcon(theme) {
        const btn  = document.getElementById('darkModeToggle');
        const icon = document.getElementById('darkModeIcon');
        if (!btn || !icon) return;

        if (theme === DARK) {
            icon.className = 'fas fa-sun';
            btn.setAttribute('title', 'Mode Terang');
        } else {
            icon.className = 'fas fa-moon';
            btn.setAttribute('title', 'Mode Gelap');
        }
    }

    function toggle() {
        const current = document.documentElement.getAttribute('data-theme') || LIGHT;
        const next    = current === DARK ? LIGHT : DARK;
        apply(next);
        SinoraToast.show(
            next === DARK ? 'Mode Gelap Aktif 🌙' : 'Mode Terang Aktif ☀️',
            next === DARK ? 'Tampilan beralih ke mode gelap' : 'Tampilan beralih ke mode terang',
            'info',
            2000
        );
    }

    function init() {
        apply(getPreference());
        const btn = document.getElementById('darkModeToggle');
        if (btn) btn.addEventListener('click', toggle);
    }

    return { init, toggle, apply };
})();


/* ============================================================
   2. TOAST NOTIFICATION SYSTEM
   ============================================================ */
const SinoraToast = (function () {
    const ICONS = {
        success: 'fas fa-check-circle',
        danger:  'fas fa-times-circle',
        warning: 'fas fa-exclamation-triangle',
        info:    'fas fa-info-circle',
    };

    const TITLES = {
        success: 'Berhasil!',
        danger:  'Error!',
        warning: 'Perhatian!',
        info:    'Info',
    };

    function getOrCreateContainer() {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    function show(title, message, type = 'info', duration = 4000) {
        const container = getOrCreateContainer();
        const icon      = ICONS[type] || ICONS.info;
        const heading   = title || TITLES[type] || 'Notifikasi';

        const toast = document.createElement('div');
        toast.className = `sinora-toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-icon"><i class="${icon}"></i></div>
            <div class="toast-body">
                <div class="toast-title">${heading}</div>
                ${message ? `<div class="toast-msg">${message}</div>` : ''}
            </div>
            <button class="toast-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
        `;

        container.appendChild(toast);

        // Close button
        toast.querySelector('.toast-close').addEventListener('click', () => dismiss(toast));

        // Auto dismiss
        if (duration > 0) {
            setTimeout(() => dismiss(toast), duration);
        }

        return toast;
    }

    function dismiss(toast) {
        if (!toast || toast.classList.contains('toast-exit')) return;
        toast.classList.add('toast-exit');
        setTimeout(() => toast.remove(), 320);
    }

    // Shortcuts
    function success(msg, title) { return show(title || 'Berhasil!',     msg, 'success'); }
    function error(msg, title)   { return show(title || 'Terjadi Error', msg, 'danger');  }
    function warning(msg, title) { return show(title || 'Perhatian',     msg, 'warning'); }
    function info(msg, title)    { return show(title || 'Info',          msg, 'info');    }

    return { show, dismiss, success, error, warning, info };
})();

// Expose globally
window.SinoraToast = SinoraToast;


/* ============================================================
   3. SCROLL REVEAL
   ============================================================ */
const SinoraReveal = (function () {
    function init() {
        const elements = document.querySelectorAll('.reveal');
        if (!elements.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px',
        });

        elements.forEach((el) => observer.observe(el));
    }

    return { init };
})();


/* ============================================================
   4. ANIMATED COUNTER
   ============================================================ */
const SinoraCounter = (function () {
    function animateValue(el, start, end, duration) {
        const range    = end - start;
        const minTimer = 30;
        const stepTime = Math.max(Math.abs(Math.floor(duration / range)), minTimer);
        const startTime = new Date().getTime();
        const endTime   = startTime + duration;
        let timer;

        function run() {
            const now  = new Date().getTime();
            const remaining = Math.max((endTime - now) / duration, 0);
            const value = Math.round(end - remaining * range);
            el.textContent = value.toLocaleString('id-ID');
            if (value === end) {
                clearInterval(timer);
            }
        }

        timer = setInterval(run, stepTime);
        run();
    }

    function init() {
        const counters = document.querySelectorAll('[data-counter]');
        if (!counters.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const el  = entry.target;
                    const end = parseInt(el.dataset.counter, 10);
                    if (!isNaN(end)) {
                        animateValue(el, 0, end, 1500);
                    }
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach((el) => observer.observe(el));
    }

    return { init };
})();


/* ============================================================
   5. NAVBAR SCROLL EFFECT
   ============================================================ */
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, { passive: true });
}


/* ============================================================
   6. BOOTSTRAP TOOLTIPS & FORM VALIDATION
   ============================================================ */
function initBootstrap() {
    // Tooltips
    const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipEls.forEach((el) => new bootstrap.Tooltip(el));

    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Auto-dismiss Bootstrap alerts
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach((alert) => {
        setTimeout(() => {
            if (alert && document.body.contains(alert)) {
                try { new bootstrap.Alert(alert).close(); } catch (_) {}
            }
        }, 5000);
    });
}


/* ============================================================
   7. PASSWORD STRENGTH CHECKER
   ============================================================ */
function checkPasswordStrength(password) {
    let score = 0;
    if (password.length >= 8)                               score++;
    if (/[a-z]/.test(password))                            score++;
    if (/[A-Z]/.test(password))                            score++;
    if (/[0-9]/.test(password))                            score++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password))          score++;

    if (score <= 2) return { text: 'Lemah',  class: 'weak'   };
    if (score <= 3) return { text: 'Sedang', class: 'medium' };
    return           { text: 'Kuat',   class: 'strong' };
}

function initPasswordStrength() {
    const passwordInput = document.getElementById('password');
    if (!passwordInput) return;

    passwordInput.addEventListener('input', function () {
        const indicator = document.getElementById('password-strength');
        if (!indicator) return;
        const result = checkPasswordStrength(this.value);
        indicator.textContent = result.text;
        indicator.className = `password-strength ${result.class}`;
    });
}


/* ============================================================
   8. IMAGE PREVIEW
   ============================================================ */
function initImagePreview() {
    const fileInputs = document.querySelectorAll('input[type="file"][accept^="image"]');
    fileInputs.forEach((input) => {
        input.addEventListener('change', function () {
            const previewId = this.dataset.preview;
            const preview   = previewId ? document.getElementById(previewId) : null;
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
}


/* ============================================================
   9. CHARACTER COUNTER
   ============================================================ */
function initCharCounter() {
    const textareas = document.querySelectorAll('textarea[data-max-length]');
    textareas.forEach((textarea) => {
        const counter = document.createElement('small');
        counter.className = 'form-text character-counter';
        counter.style.color = 'var(--text-muted)';
        counter.textContent = `0/${textarea.dataset.maxLength} karakter`;
        textarea.parentNode.appendChild(counter);

        textarea.addEventListener('input', function () {
            const current = this.value.length;
            const max     = parseInt(this.dataset.maxLength, 10);
            counter.textContent = `${current}/${max} karakter`;
            counter.style.color = current > max ? 'var(--danger)' : 'var(--text-muted)';
        });
    });
}


/* ============================================================
   10. DYNAMIC EXPERIENCE FIELDS
   ============================================================ */
function initDynamicFields() {
    const addBtn = document.getElementById('add-experience');
    if (!addBtn) return;

    addBtn.addEventListener('click', () => {
        const container = document.getElementById('pengalaman-container');
        if (!container) return;
        const index = container.children.length;
        const html = `
            <div class="experience-item mb-2">
                <div class="input-group">
                    <input type="text" class="form-control" name="pengalaman[${index}]"
                           placeholder="Nama organisasi dan jabatan">
                    <button type="button" class="btn btn-outline-danger remove-experience">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', (e) => {
        if (e.target.closest('.remove-experience')) {
            e.target.closest('.experience-item').remove();
        }
    });
}


/* ============================================================
   11. SEARCH (Fallback — halaman yang tidak punya inline search)
   ============================================================ */
function initSearch() {
    const input = document.getElementById('search-organisasi');
    if (!input) return;

    input.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('.organisasi-card').forEach((card) => {
            const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
            const desc  = card.querySelector('.card-text')?.textContent.toLowerCase() || '';
            const badge = card.querySelector('.badge')?.textContent.toLowerCase() || '';
            card.style.display = (title + desc + badge).includes(term) ? '' : 'none';
        });
    });
}


/* ============================================================
   12. AJAX UTILITIES
   ============================================================ */
async function submitPendaftaran(formData, endpoint) {
    try {
        const res    = await fetch(endpoint, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        const result = await res.json();

        if (result.success) {
            SinoraToast.success(result.message || 'Pendaftaran berhasil!');
            setTimeout(() => {
                window.location.href = result.redirect || 'index.php';
            }, 2000);
        } else {
            SinoraToast.error(result.message || 'Terjadi kesalahan.');
        }
    } catch (err) {
        SinoraToast.error('Koneksi gagal. Coba lagi.');
    }
}

// Legacy compat
function showAlert(message, type) {
    const map = { success: 'success', danger: 'error', warning: 'warning', info: 'info' };
    const fn  = map[type] || 'info';
    SinoraToast[fn](message);
}

function confirmAction(message, callback) {
    if (confirm(message)) callback();
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric', month: 'long', day: 'numeric',
    });
}


/* ============================================================
   13. AUTO-SHOW PHP SESSION ALERTS AS TOAST
   ============================================================ */
function initSessionAlerts() {
    // Jika ada hidden div dengan data alert dari PHP session
    const alertEl = document.getElementById('php-session-alert');
    if (!alertEl) return;

    const message = alertEl.dataset.message;
    const type    = alertEl.dataset.type || 'info';
    if (message) {
        setTimeout(() => SinoraToast.show(null, message, type), 400);
    }
}


/* ============================================================
   14. INIT ALL
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    SinoraTheme.init();
    SinoraReveal.init();
    SinoraCounter.init();
    initNavbarScroll();
    initBootstrap();
    initPasswordStrength();
    initImagePreview();
    initCharCounter();
    initDynamicFields();
    initSearch();
    initSessionAlerts();
});