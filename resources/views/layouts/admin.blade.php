<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Panel Login') — Smart Village Talang Marap</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { primary: '#2E7D32' }
                }
            }
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brutal-btn { border: 2px solid #212121; box-shadow: 3px 3px 0 #212121; font-weight: 700; transition: all .15s; }
        .brutal-btn:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #212121; }
        @keyframes modal-fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes modal-scale-in {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-animate-fade { animation: modal-fade-in 0.2s ease-out forwards; }
        .modal-animate-scale { animation: modal-scale-in 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .sidebar-link { display:flex; align-items:center; gap:10px; padding:8px 12px; border-radius:12px; font-weight:600; font-size:14px; transition:all .2s; color:#64748b; }
        .sidebar-link:hover { color:#111827; background:rgba(46,125,50,0.08); }
        .sidebar-link.active { background:#2E7D32; color:white; box-shadow:2px 2px 0 #1B5E20; }

        .dark body { background-color: #020617; color: #f8fafc; }
        .dark .sidebar-link { color:#94a3b8; }
        .dark .sidebar-link:hover { color:white; background:rgba(255,255,255,0.1); }
        .dark .bg-white { background-color: #111827 !important; }
        .dark .bg-slate-50 { background-color: #111827 !important; }
        .dark .bg-slate-100 { background-color: #1f2937 !important; }
        .dark .border-slate-200 { border-color: #374151 !important; }
        .dark .border-slate-300 { border-color: #4b5563 !important; }
        .dark .text-slate-700 { color: #e2e8f0 !important; }
        .dark .text-slate-600 { color: #cbd5e1 !important; }
        .dark .text-slate-500 { color: #94a3b8 !important; }
        .dark .text-slate-400 { color: #94a3b8 !important; }
        .dark .text-slate-300 { color: #cbd5e1 !important; }
        .dark .text-slate-200 { color: #f1f5f9 !important; }
        .dark input, .dark textarea, .dark select {
            background-color: #111827;
            color: #f8fafc;
            border-color: #4b5563;
        }
        .dark input::placeholder, .dark textarea::placeholder { color: #94a3b8; }
        .dark table thead th, .dark table tbody td { border-color: #374151; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen overflow-x-hidden bg-slate-50 text-slate-900 flex transition-colors duration-300 dark:bg-[#060816] dark:text-slate-100">

<!-- Sidebar -->
<aside id="sidebar" class="w-[85vw] max-w-64 sm:w-64 bg-white text-slate-800 flex flex-col shrink-0 border-r-4 border-[#2E7D32] transition-all duration-300 fixed lg:relative inset-y-0 left-0 z-30 -translate-x-full lg:translate-x-0 dark:bg-[#0f172a] dark:text-slate-100">
    @php
    $adminLogo = \App\Models\Pengaturan::where('key', 'logo')->value('value');
    @endphp
    <div class="p-4 border-b-2 border-slate-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
            @if(!empty($adminLogo))
                <img src="@fotoUrl($adminLogo)" alt="Logo Desa" class="w-9 h-9 rounded-lg object-cover border-2 border-[#2E7D32]"/>
            @else
                <div class="w-9 h-9 bg-[#2E7D32] rounded-lg flex items-center justify-center shrink-0">
                    <span class="text-white font-black">T</span>
                </div>
            @endif
            <div>
                <p class="text-slate-900 font-black text-sm dark:text-white">Panel Login</p>
                <p class="text-slate-500 text-xs dark:text-slate-400">Desa Talang Marap</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-3 px-3 space-y-4">
        @php
        $groups = [
            'Utama' => [['icon'=>'📊','label'=>'Dashboard','route'=>'admin.dashboard']],
            'Konten Desa' => [
                ['icon'=>'📰','label'=>'Berita','route'=>'admin.berita.index'],
                ['icon'=>'🖼️','label'=>'Galeri','route'=>'admin.galeri.index'],
                ['icon'=>'📅','label'=>'Agenda','route'=>'admin.agenda.index'],
            ],
            'Profil Desa' => [
                ['icon'=>'👥','label'=>'Perangkat Desa','route'=>'admin.perangkat.index'],
                ['icon'=>'📈','label'=>'Statistik','route'=>'admin.statistik.index'],
                ['icon'=>'🏠','label'=>'Peta Rumah','route'=>'admin.peta-rumah.index'],
            ],
            'Potensi Desa' => [
                ['icon'=>'⛰️','label'=>'Wisata','route'=>'admin.wisata.index'],
                ['icon'=>'🛍️','label'=>'UMKM','route'=>'admin.umkm.index'],
            ],
            'KKN' => [
                ['icon'=>'🎓','label'=>'Anggota KKN','route'=>'admin.kkn-anggota.index'],
                ['icon'=>'📋','label'=>'Program Kerja','route'=>'admin.kkn-proker.index'],
            ],
            'Layanan' => [
                ['icon'=>'💬','label'=>'Aspirasi','route'=>'admin.aspirasi.index'],
                ['icon'=>'✉️','label'=>'Pesan Kontak','route'=>'admin.pesan-kontak.index'],
            ],
            'Sistem' => [
                ['icon'=>'⚙️','label'=>'Pengaturan','route'=>'admin.pengaturan.index'],
                ['icon'=>'👤','label'=>'User','route'=>'admin.users.index'],
            ],
        ];
        @endphp

        @foreach($groups as $groupName => $items)
        <div>
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-wider px-2 mb-1 dark:text-slate-400" data-admin-group-id="{{ $groupName }}" data-admin-group-en="{{ $groupName }}">{{ $groupName }}</p>
            @foreach($items as $item)
            <a href="{{ route($item['route']) }}"
               class="sidebar-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                <span>{{ $item['icon'] }}</span>
                <span class="truncate" data-admin-label-id="{{ $item['label'] }}" data-admin-label-en="{{ $item['label'] }}">{{ $item['label'] }}</span>
            </a>
            @endforeach
        </div>
        @endforeach
    </nav>

    <div class="p-3 border-t-2 border-slate-200 dark:border-gray-700">
        <div class="flex items-center gap-2 px-2 py-2 mb-2">
            <div class="w-7 h-7 bg-[#2E7D32] rounded-full flex items-center justify-center shrink-0">
                <span class="text-white text-xs font-black">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-slate-900 text-xs font-bold truncate dark:text-white">{{ auth()->user()->email ?? '' }}</p>
                <p class="text-slate-500 text-[10px] dark:text-slate-400">{{ ucfirst(auth()->user()->role ?? 'editor') }}</p>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-red-400 hover:text-white hover:bg-red-500/20 rounded-xl transition-all text-sm font-semibold">
                🚪 Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Overlay mobile -->
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/50 z-20 lg:hidden" onclick="toggleSidebar()"></div>

<!-- Main -->
<div class="flex-1 flex flex-col overflow-hidden min-w-0">
    <header class="bg-white text-slate-900 border-b-4 border-[#2E7D32] px-3 py-3 sm:px-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between shrink-0 shadow-[0_4px_0_#e2e8f0] dark:bg-[#111827] dark:text-white dark:shadow-[0_4px_0_#111827]">
        <div class="flex items-center gap-3 min-w-0">
            <button onclick="toggleSidebar()"
                class="w-9 h-9 border-2 border-[#212121] rounded-lg flex items-center justify-center hover:bg-[#2E7D32] hover:text-white transition-all shadow-[2px_2px_0_#212121]">
                ☰
            </button>
            <div class="min-w-0">
                <p class="font-black text-sm text-slate-900 dark:text-white" data-admin-label-id="@yield('page_title', 'Panel Login')" data-admin-label-en="@yield('page_title', 'Admin Panel')">@yield('page_title', 'Panel Login')</p>
                <p class="text-slate-500 text-xs dark:text-slate-400" data-admin-label-id="Smart Village Talang Marap" data-admin-label-en="Smart Village Talang Marap">Smart Village Talang Marap</p>
            </div>
        </div>
        <div class="flex flex-wrap items-center justify-end gap-2">
            <button type="button" onclick="toggleAdminLang()"
                class="h-9 min-w-9 px-2 border-2 border-[#2E7D32] rounded-lg flex items-center justify-center hover:bg-[#2E7D32] hover:text-white transition-all text-sm font-black"
                title="Ganti Bahasa / Switch Language">
                <span id="adminLangLabel">EN</span>
            </button>
            <button type="button" onclick="toggleAdminTheme()"
                class="w-9 h-9 border-2 border-[#2E7D32] rounded-lg flex items-center justify-center hover:bg-[#2E7D32] hover:text-white transition-all text-sm"
                title="Toggle Dark Mode">
                <span id="adminThemeIcon">🌙</span>
            </button>
            <a href="{{ route('home') }}" target="_blank"
               class="text-xs font-bold text-[#2E7D32] border-2 border-[#2E7D32] px-3 py-1.5 rounded-lg hover:bg-[#2E7D32] hover:text-white transition-all"
               data-admin-label-id="🌐 Lihat Website" data-admin-label-en="🌐 View Website">
                🌐 Lihat Website
            </a>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto p-3 sm:p-4 md:p-6">
        @include('layouts.partials.flash')

        @yield('content')
    </main>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

function toggleAdminTheme() {
    const root = document.documentElement;
    const isDark = !root.classList.contains('dark');
    root.classList.toggle('dark', isDark);
    localStorage.setItem('darkMode', isDark ? 'true' : 'false');
    const icon = document.getElementById('adminThemeIcon');
    if (icon) icon.textContent = isDark ? '☀️' : '🌙';
}

function applyAdminLanguage(lang) {
    const isEnglish = lang === 'EN';
    document.documentElement.lang = isEnglish ? 'en' : 'id';
    localStorage.setItem('adminLang', lang);

    document.querySelectorAll('[data-admin-label-id]').forEach(function (el) {
        const text = isEnglish ? (el.getAttribute('data-admin-label-en') || el.textContent) : (el.getAttribute('data-admin-label-id') || el.textContent);
        if (text) el.textContent = text;
    });

    document.querySelectorAll('[data-admin-group-id]').forEach(function (el) {
        const text = isEnglish ? (el.getAttribute('data-admin-group-en') || el.textContent) : (el.getAttribute('data-admin-group-id') || el.textContent);
        if (text) el.textContent = text;
    });

    const langBtn = document.getElementById('adminLangLabel');
    if (langBtn) langBtn.textContent = isEnglish ? 'ID' : 'EN';
}

function toggleAdminLang() {
    const current = localStorage.getItem('adminLang') || 'ID';
    applyAdminLanguage(current === 'ID' ? 'EN' : 'ID');
}

(function () {
    const saved = localStorage.getItem('darkMode');
    const isDark = saved === 'true';
    document.documentElement.classList.toggle('dark', isDark);
    const icon = document.getElementById('adminThemeIcon');
    if (icon) icon.textContent = isDark ? '☀️' : '🌙';

    const lang = localStorage.getItem('adminLang') || 'ID';
    applyAdminLanguage(lang);
})();

// ── Delete Modal ──────────────────────────────────────
var _deleteUrl = null;

function showDeleteModal(url, title, msg) {
    _deleteUrl = (typeof url === 'string') ? url : url.getAttribute('action');
    document.getElementById('deleteModalTitle').textContent = title || 'Hapus Data';
    document.getElementById('deleteModalMsg').textContent   = msg   || 'Data yang dihapus tidak bisa dikembalikan.';
    
    const modal = document.getElementById('deleteModal');
    const content = document.getElementById('deleteModalContent');
    modal.classList.remove('hidden');
    modal.classList.add('modal-animate-fade');
    content.classList.add('modal-animate-scale');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const content = document.getElementById('deleteModalContent');
    modal.classList.add('hidden');
    modal.classList.remove('modal-animate-fade');
    content.classList.remove('modal-animate-scale');
    _deleteUrl = null;
}

function executeDelete() {
    if (!_deleteUrl) return;

    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var btn  = document.getElementById('deleteConfirmBtn');
    btn.textContent = 'Menghapus...';
    btn.disabled    = true;

    var form    = document.createElement('form');
    form.method = 'POST';
    form.action = _deleteUrl;

    var t = document.createElement('input');
    t.type = 'hidden'; t.name = '_token'; t.value = csrf;

    var m = document.createElement('input');
    m.type = 'hidden'; m.name = '_method'; m.value = 'DELETE';

    form.appendChild(t);
    form.appendChild(m);
    document.body.appendChild(form);
    form.submit();
}
</script>

{{-- ── Delete Confirmation Modal ── --}}
<div id="deleteModal"
     class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4"
     style="background:rgba(0,0,0,0.6)">
    <div id="deleteModalContent" 
         class="bg-white dark:bg-[#111827] border-4 border-[#212121] dark:border-[#4b5563] rounded-2xl shadow-[8px_8px_0_#212121]
                w-full max-w-sm p-7 text-center">
        <div class="w-16 h-16 bg-red-100 dark:bg-red-950/30 border-4 border-red-300 dark:border-red-800 rounded-2xl flex items-center
                    justify-center mx-auto mb-4 text-3xl">
            🗑️
        </div>
        <h3 class="font-black text-lg text-[#212121] dark:text-slate-100 mb-2" id="deleteModalTitle">Hapus Data</h3>
        <p class="text-gray-500 dark:text-slate-400 text-sm mb-6" id="deleteModalMsg">
            Data yang dihapus tidak bisa dikembalikan.
        </p>
        <div class="flex gap-3 justify-center">
            <button onclick="closeDeleteModal()"
                    class="brutal-btn bg-gray-200 text-gray-700 dark:bg-slate-700 dark:text-slate-200 dark:border-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm flex-1">
                Batal
            </button>
            <button id="deleteConfirmBtn"
                    onclick="executeDelete()"
                    class="brutal-btn bg-red-500 text-white dark:border-red-700 px-6 py-2.5 rounded-xl font-black text-sm flex-1">
                🗑️ Ya, Hapus
            </button>
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
