{{-- ============================================================
     Partial: Navbar
     Dipakai di: layouts/public.blade.php
     ============================================================ --}}
@php
$navItems = [
    ['labelID' => 'Beranda', 'labelEN' => 'Home',    'route' => 'home'],
    ['labelID' => 'Profil',  'labelEN' => 'Profile', 'route' => 'profil'],
    ['labelID' => 'Berita',  'labelEN' => 'News',    'route' => 'berita'],
    ['labelID' => 'Wisata',  'labelEN' => 'Tourism', 'route' => 'wisata'],
    ['labelID' => 'UMKM',    'labelEN' => 'UMKM',    'route' => 'umkm'],
    ['labelID' => 'KKN',     'labelEN' => 'KKN',     'route' => 'kkn'],
    ['labelID' => 'Galeri',  'labelEN' => 'Gallery', 'route' => 'galeri'],
    ['labelID' => 'Kontak',  'labelEN' => 'Contact', 'route' => 'kontak'],
];
@endphp

<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="container-custom">

        {{-- ── Top bar ── --}}
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @if(!empty($desa['logo']))
                    <img src="@fotoUrl($desa['logo'])" alt="Logo Desa" class="w-10 h-10 rounded-xl border-[3px] border-[#212121] shadow-[3px_3px_0_#212121] object-cover"/>
                @else
                    <div class="w-10 h-10 rounded-xl border-[3px] border-[#212121] bg-[#2E7D32]
                                flex items-center justify-center shadow-[3px_3px_0_#212121]">
                        <span class="text-white font-black text-lg">T</span>
                    </div>
                @endif
                <div class="hidden sm:block">
                    <p class="font-black text-sm leading-tight text-[#2E7D32]" data-i18n="nav_portal">Smart Village</p>
                    <p class="font-bold text-xs text-gray-600 dark:text-gray-400">Desa Talang Marap</p>
                </div>
            </a>

            {{-- Desktop links --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   data-nav-id="{{ $item['labelID'] }}"
                   data-nav-en="{{ $item['labelEN'] }}"
                   class="nav-link px-3 py-2 rounded-lg font-semibold text-sm transition-all
                          hover:bg-[#2E7D32] hover:text-white
                          {{ request()->routeIs($item['route'])
                              ? 'bg-[#2E7D32] text-white'
                              : 'text-[#212121] dark:text-gray-200' }}">
                    {{ $item['labelID'] }}
                </a>
                @endforeach
            </div>

            {{-- Action buttons --}}
            <div class="flex items-center gap-2">

                {{-- Dark mode toggle --}}
                <button onclick="toggleDark()"
                        title="Toggle Dark / Light Mode"
                        class="w-9 h-9 rounded-lg border-2 border-[#212121] dark:border-gray-500
                               flex items-center justify-center text-base
                               bg-white dark:bg-[#2a2a2a] dark:text-gray-200
                               hover:bg-[#2E7D32] hover:text-white hover:border-[#2E7D32]
                               shadow-[2px_2px_0_#212121] dark:shadow-[2px_2px_0_#555]
                               transition-all">
                    <span id="darkIcon">🌙</span>
                </button>

                {{-- Language toggle --}}
                <button onclick="toggleLang()"
                        title="Ganti Bahasa / Switch Language"
                        class="w-9 h-9 rounded-lg border-2 border-[#212121] dark:border-gray-500
                               flex items-center justify-center text-xs font-black
                               bg-white dark:bg-[#2a2a2a] dark:text-gray-200
                               hover:bg-[#2E7D32] hover:text-white hover:border-[#2E7D32]
                               shadow-[2px_2px_0_#212121] dark:shadow-[2px_2px_0_#555]
                               transition-all">
                    <span id="langLabel">ID</span>
                </button>

                {{-- Panel login link (desktop only) --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="hidden md:flex items-center gap-1.5 px-3 py-2 rounded-lg
                          border-2 border-[#212121] bg-[#212121] text-white text-xs font-black
                          shadow-[2px_2px_0_#2E7D32] hover:bg-[#2E7D32] transition-all">
                    🔧 Panel Login
                </a>

                {{-- Hamburger (mobile) --}}
                <button onclick="toggleMobileMenu()"
                        class="lg:hidden w-9 h-9 rounded-lg border-2 border-[#212121] dark:border-gray-500
                               flex items-center justify-center
                               bg-white dark:bg-[#2a2a2a] dark:text-gray-200
                               hover:bg-[#2E7D32] hover:text-white
                               shadow-[2px_2px_0_#212121] transition-all">
                    ☰
                </button>
            </div>
        </div>

        {{-- Mobile dropdown --}}
        <div id="mobileMenu"
             class="hidden lg:hidden bg-white dark:bg-[#1e1e1e]
                    border-4 border-[#212121] dark:border-gray-600
                    rounded-2xl shadow-[6px_6px_0_#212121] mb-4 overflow-hidden">
            @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               data-nav-id="{{ $item['labelID'] }}"
               data-nav-en="{{ $item['labelEN'] }}"
               class="nav-link block px-5 py-3 font-semibold text-sm
                      border-b border-gray-100 dark:border-gray-700
                      hover:bg-[#2E7D32] hover:text-white transition-colors
                      {{ request()->routeIs($item['route'])
                          ? 'bg-[#2E7D32] text-white'
                          : 'dark:text-gray-200' }}">
                {{ $item['labelID'] }}
            </a>
            @endforeach
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-5 py-3 font-black text-sm
                      bg-[#212121] text-white hover:bg-[#2E7D32] transition-colors">
                🔧 Panel Login
            </a>
        </div>

    </div>
</nav>
