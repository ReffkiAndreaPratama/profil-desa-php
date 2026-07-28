/* ============================================================
   Smart Village Talang Marap — Global JS
   Dark Mode + Language (ID/EN) + Navbar scroll
   ============================================================ */

/* ── Navbar scroll effect ──────────────────────────────────── */
window.addEventListener('scroll', function () {
    var nav = document.getElementById('navbar');
    if (!nav) return;
    if (window.scrollY > 20) {
        nav.classList.add('scrolled', 'bg-white/95', 'backdrop-blur-md', 'border-b-4', 'border-[#212121]', 'shadow-[0_4px_0_#212121]');
    } else {
        nav.classList.remove('scrolled', 'bg-white/95', 'backdrop-blur-md', 'border-b-4', 'border-[#212121]', 'shadow-[0_4px_0_#212121]');
    }
});

/* ── Mobile menu toggle ────────────────────────────────────── */
function toggleMobileMenu() {
    var menu = document.getElementById('mobileMenu');
    if (menu) menu.classList.toggle('hidden');
}

/* ============================================================
   DARK MODE
   ============================================================ */
function toggleDark() {
    var isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('darkMode', isDark ? 'true' : 'false');
    _syncDarkIcons();
    _syncFooterIcons();
}

function _syncDarkIcons() {
    var isDark = document.documentElement.classList.contains('dark');
    var icon = document.getElementById('darkIcon');
    if (icon) icon.textContent = isDark ? '☀️' : '🌙';
}

/* ============================================================
   LANGUAGE  (ID / EN)
   ============================================================ */
var _currentLang = localStorage.getItem('lang') || 'ID';

/**
 * All translatable strings used across the site.
 * Key → { ID: '...', EN: '...' }
 */
var _translations = {
    /* Navbar */
    nav_portal:         { ID: 'Smart Village',              EN: 'Smart Village' },

    /* Hero — home page */
    hero_badge:         { ID: '🌿 Portal Resmi Desa Digital', EN: '🌿 Official Digital Village Portal' },
    hero_btn1:          { ID: 'Jelajahi Desa →',            EN: 'Explore Village →' },
    hero_btn2:          { ID: '▶ Lihat Potensi',            EN: '▶ See Potential' },

    /* Quick-access menu */
    section_menu:       { ID: 'MENU CEPAT',                 EN: 'QUICK ACCESS' },
    section_menu_sub:   { ID: 'Semua informasi dan layanan desa dalam satu portal',
                          EN: 'All village information and services in one portal' },

    /* News section */
    section_news:       { ID: 'BERITA TERKINI',             EN: 'LATEST NEWS' },
    btn_all_news:       { ID: 'Semua Berita →',             EN: 'All News →' },

    /* Agenda section */
    section_agenda:     { ID: 'AGENDA',                     EN: 'SCHEDULE' },
    agenda_none:        { ID: 'Belum ada agenda',           EN: 'No upcoming events' },
    agenda_link:        { ID: 'Lihat Kalender Lengkap →',   EN: 'View Full Calendar →' },

    /* Statistics section */
    section_stats:      { ID: 'STATISTIK',                  EN: 'STATISTICS' },
    stats_link:         { ID: 'Dashboard Statistik Lengkap →', EN: 'Full Statistics Dashboard →' },
    stat_penduduk_l:    { ID: 'Total Penduduk',             EN: 'Total Residents' },
    stat_kk_l:          { ID: 'Kepala Keluarga',            EN: 'Households' },
    stat_umkm_l:        { ID: 'UMKM Aktif',                 EN: 'Active UMKM' },
    stat_wisata_l:      { ID: 'Wisatawan/Bulan',            EN: 'Tourists/Month' },

    /* Aspirasi CTA */
    cta_aspirasi_h:     { ID: 'Suarakan Aspirasimu!',       EN: 'Voice Your Aspirations!' },
    cta_aspirasi_p:     { ID: 'Ada saran, keluhan, atau ide untuk kemajuan desa? Sampaikan aspirasi Anda langsung kepada perangkat desa.',
                          EN: 'Have suggestions, complaints, or ideas for the village? Share your aspirations directly with village officials.' },
    cta_aspirasi_btn:   { ID: 'Kirim Aspirasi →',           EN: 'Send Aspiration →' },

    /* Footer */
    footer_layanan:     { ID: 'LAYANAN',                    EN: 'SERVICES' },
    footer_kontak:      { ID: 'KONTAK',                     EN: 'CONTACT' },
    footer_copy:        { ID: 'Smart Village Talang Marap. Hak cipta dilindungi.',
                          EN: 'Smart Village Talang Marap. All rights reserved.' },
};

/**
 * Apply language to every translated element on the page.
 * Called on page load and whenever the user toggles.
 */
function applyLang(lang) {
    _currentLang = lang;
    localStorage.setItem('lang', lang);

    /* html[lang] attribute */
    document.getElementById('htmlRoot').lang = lang === 'ID' ? 'id' : 'en';

    /* Navbar toggle button label — shows the OTHER language as the call-to-action */
    var btn = document.getElementById('langLabel');
    if (btn) btn.textContent = lang === 'ID' ? 'EN' : 'ID';

    /* Nav links (desktop + mobile) */
    document.querySelectorAll('.nav-link').forEach(function (el) {
        var id = el.getAttribute('data-nav-id');
        var en = el.getAttribute('data-nav-en');
        if (id && en) el.textContent = lang === 'ID' ? id : en;
    });

    /* Generic [data-i18n] elements */
    document.querySelectorAll('[data-i18n]').forEach(function (el) {
        var key = el.getAttribute('data-i18n');
        if (_translations[key]) el.textContent = _translations[key][lang] || el.textContent;
    });

    /* Hero stat labels [data-stat-id / data-stat-en] */
    document.querySelectorAll('[data-stat-id]').forEach(function (el) {
        el.textContent = lang === 'EN'
            ? (el.getAttribute('data-stat-en') || el.textContent)
            : (el.getAttribute('data-stat-id') || el.textContent);
    });

    /* Quick-menu labels [data-menu-id / data-menu-en] */
    document.querySelectorAll('[data-menu-id]').forEach(function (el) {
        el.textContent = lang === 'EN'
            ? (el.getAttribute('data-menu-en') || el.textContent)
            : (el.getAttribute('data-menu-id') || el.textContent);
    });

    _syncFooterIcons();
}

function toggleLang() {
    applyLang(_currentLang === 'ID' ? 'EN' : 'ID');
}

/* ── Footer icon sync (dark icon + lang label) ─────────────── */
function _syncFooterIcons() {
    var isDark = document.documentElement.classList.contains('dark');

    var fi = document.getElementById('darkIconFooter');
    var fl = document.getElementById('darkModeLabel');
    var ll = document.getElementById('langLabelFooter');

    if (fi) fi.textContent = isDark ? '☀️' : '🌙';
    if (fl) fl.textContent = isDark
        ? (_currentLang === 'ID' ? 'Mode Siang' : 'Light Mode')
        : (_currentLang === 'ID' ? 'Mode Malam' : 'Dark Mode');
    if (ll) ll.textContent = _currentLang === 'ID' ? 'EN' : 'ID';
}

/* ============================================================
   INIT — run once DOM is ready
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    _syncDarkIcons();
    applyLang(_currentLang);
});
