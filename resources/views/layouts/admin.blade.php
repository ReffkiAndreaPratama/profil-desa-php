<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin') — Portal Desa Talang Marap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#2E7D32' } } } }</script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brutal-btn { border: 2px solid #212121; box-shadow: 3px 3px 0 #212121; font-weight: 700; transition: all .15s; }
        .brutal-btn:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #212121; }
        .sidebar-link { display:flex; align-items:center; gap:10px; padding:8px 12px; border-radius:12px; font-weight:600; font-size:14px; transition:all .2s; color:#9ca3af; }
        .sidebar-link:hover { color:white; background:rgba(255,255,255,0.1); }
        .sidebar-link.active { background:#2E7D32; color:white; box-shadow:2px 2px 0 #1B5E20; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 overflow-hidden h-screen flex">

<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-[#212121] flex flex-col shrink-0 border-r-4 border-[#2E7D32] transition-all duration-300 fixed lg:relative inset-y-0 left-0 z-30 -translate-x-full lg:translate-x-0">
    <div class="p-4 border-b-2 border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#2E7D32] rounded-lg flex items-center justify-center shrink-0">
                <span class="text-white font-black">T</span>
            </div>
            <div>
                <p class="text-white font-black text-sm">Admin Panel</p>
                <p class="text-gray-400 text-xs">Desa Talang Marap</p>
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
                ['icon'=>'📄','label'=>'Dokumen','route'=>'admin.dokumen.index'],
            ],
            'Profil Desa' => [
                ['icon'=>'👥','label'=>'Perangkat Desa','route'=>'admin.perangkat.index'],
                ['icon'=>'📈','label'=>'Statistik','route'=>'admin.statistik.index'],
            ],
            'Potensi Desa' => [
                ['icon'=>'⛰️','label'=>'Wisata','route'=>'admin.wisata.index'],
                ['icon'=>'🛍️','label'=>'UMKM','route'=>'admin.umkm.index'],
            ],
            'SiTARA' => [
                ['icon'=>'♻️','label'=>'Bank Sampah','route'=>'admin.bank-sampah.index'],
                ['icon'=>'⚠️','label'=>'Laporan Sampah','route'=>'admin.laporan-sampah.index'],
                ['icon'=>'📊','label'=>'Data Sampah','route'=>'admin.data-sampah.index'],
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
            ],
        ];
        @endphp

        @foreach($groups as $groupName => $items)
        <div>
            <p class="text-gray-500 text-[10px] font-black uppercase tracking-wider px-2 mb-1">{{ $groupName }}</p>
            @foreach($items as $item)
            <a href="{{ route($item['route']) }}"
               class="sidebar-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                <span>{{ $item['icon'] }}</span>
                <span class="truncate">{{ $item['label'] }}</span>
            </a>
            @endforeach
        </div>
        @endforeach
    </nav>

    <div class="p-3 border-t-2 border-gray-700">
        <div class="flex items-center gap-2 px-2 py-2 mb-2">
            <div class="w-7 h-7 bg-[#2E7D32] rounded-full flex items-center justify-center shrink-0">
                <span class="text-white text-xs font-black">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-white text-xs font-bold truncate">{{ auth()->user()->email ?? '' }}</p>
                <p class="text-gray-500 text-[10px]">Administrator</p>
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
    <header class="bg-white border-b-4 border-[#212121] px-4 py-3 flex items-center justify-between shrink-0 shadow-[0_4px_0_#212121]">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()"
                class="w-9 h-9 border-2 border-[#212121] rounded-lg flex items-center justify-center hover:bg-[#2E7D32] hover:text-white transition-all shadow-[2px_2px_0_#212121]">
                ☰
            </button>
            <div>
                <p class="font-black text-sm text-[#212121]">@yield('page_title', 'Admin Panel')</p>
                <p class="text-gray-400 text-xs">Portal Digital Desa Talang Marap</p>
            </div>
        </div>
        <a href="{{ route('home') }}" target="_blank"
           class="text-xs font-bold text-[#2E7D32] border-2 border-[#2E7D32] px-3 py-1.5 rounded-lg hover:bg-[#2E7D32] hover:text-white transition-all">
            🌐 Lihat Website
        </a>
    </header>

    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border-2 border-green-500 rounded-xl text-green-800 font-semibold text-sm">
            ✅ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border-2 border-red-500 rounded-xl text-red-800 font-semibold text-sm">
            ❌ {{ session('error') }}
        </div>
        @endif
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
</script>
@stack('scripts')
</body>
</html>
