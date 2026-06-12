<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Portal Digital Desa Talang Marap')</title>
    <meta name="description" content="@yield('description', 'Portal resmi Desa Talang Marap - Kec. Kelam Tengah, Kab. Kaur, Bengkulu')"/>
    <meta name="theme-color" content="#2E7D32"/>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2E7D32',
                        secondary: '#43A047',
                        accent: '#66BB6A',
                        cream: '#FFFDF7',
                        dark: '#212121',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FFFDF7; }
        .brutal-card { border: 4px solid #212121; border-radius: 20px; box-shadow: 6px 6px 0 #212121; background: white; transition: all .2s; }
        .brutal-card:hover { transform: translate(-3px,-3px); box-shadow: 9px 9px 0 #212121; }
        .brutal-btn { border: 3px solid #212121; box-shadow: 4px 4px 0 #212121; font-weight: 700; transition: all .15s; cursor: pointer; }
        .brutal-btn:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 #212121; }
        .brutal-btn:active { transform: translate(2px,2px); box-shadow: 2px 2px 0 #212121; }
        .gradient-green { background: linear-gradient(135deg,#2E7D32 0%,#43A047 50%,#66BB6A 100%); }
        .text-gradient { background: linear-gradient(135deg,#2E7D32,#66BB6A); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .marquee-wrapper { overflow: hidden; white-space: nowrap; }
        .marquee-content { display: inline-block; animation: marquee 30s linear infinite; }
        .marquee-content:hover { animation-play-state: paused; }
        @keyframes marquee { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
        @media(max-width:640px) { .container-custom { padding: 0 16px; } }
        .container-custom { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FFFDF7]">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ open: false }">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl border-[3px] border-[#212121] bg-[#2E7D32] flex items-center justify-center shadow-[3px_3px_0_#212121]">
                    <span class="text-white font-black text-lg">T</span>
                </div>
                <div class="hidden sm:block">
                    <p class="font-black text-sm leading-tight text-[#2E7D32]">Portal Digital</p>
                    <p class="font-bold text-xs text-gray-600">Desa Talang Marap</p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center gap-1">
                @php
                $navItems = [
                    ['label'=>'Beranda','route'=>'home'],
                    ['label'=>'Profil','route'=>'profil'],
                    ['label'=>'Berita','route'=>'berita'],
                    ['label'=>'Wisata','route'=>'wisata'],
                    ['label'=>'UMKM','route'=>'umkm'],
                    ['label'=>'SiTARA','route'=>'sitara'],
                    ['label'=>'KKN','route'=>'kkn'],
                    ['label'=>'Galeri','route'=>'galeri'],
                    ['label'=>'Kontak','route'=>'kontak'],
                ];
                @endphp
                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="px-3 py-2 rounded-lg font-semibold text-sm transition-all hover:bg-[#2E7D32] hover:text-white {{ request()->routeIs($item['route']) ? 'bg-[#2E7D32] text-white' : 'text-[#212121]' }}">
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="hidden md:flex items-center gap-1.5 px-3 py-2 rounded-lg border-2 border-[#212121] bg-[#212121] text-white text-xs font-black shadow-[2px_2px_0_#2E7D32] hover:bg-[#2E7D32] transition-all">
                    🔧 Admin
                </a>
                <!-- Mobile Toggle -->
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                    class="lg:hidden w-9 h-9 rounded-lg border-2 border-[#212121] flex items-center justify-center hover:bg-[#2E7D32] hover:text-white transition-all shadow-[2px_2px_0_#212121]">
                    ☰
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white border-4 border-[#212121] rounded-2xl shadow-[6px_6px_0_#212121] mb-4 overflow-hidden">
            @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="block px-5 py-3 font-semibold text-sm border-b border-gray-100 hover:bg-[#2E7D32] hover:text-white transition-colors {{ request()->routeIs($item['route']) ? 'bg-[#2E7D32] text-white' : '' }}">
                {{ $item['label'] }}
            </a>
            @endforeach
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-5 py-3 font-black text-sm bg-[#212121] text-white hover:bg-[#2E7D32] transition-colors">
                🔧 Panel Admin
            </a>
        </div>
    </div>
</nav>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 20) {
            nav.classList.add('bg-white/95','backdrop-blur-md','border-b-4','border-[#212121]','shadow-[0_4px_0_#212121]');
        } else {
            nav.classList.remove('bg-white/95','backdrop-blur-md','border-b-4','border-[#212121]','shadow-[0_4px_0_#212121]');
        }
    });
</script>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-[#212121] text-white border-t-4 border-[#2E7D32]">
    <div class="container-custom py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-[#2E7D32] border-2 border-[#66BB6A] flex items-center justify-center">
                        <span class="text-white font-black text-xl">T</span>
                    </div>
                    <div>
                        <p class="font-black text-lg">Desa Talang Marap</p>
                        <p class="text-gray-400 text-sm">Kec. Kelam Tengah, Kab. Kaur, Bengkulu</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    Portal resmi Desa Talang Marap. Mengenal Desa, Mengelola Data, Membangun Masa Depan.
                </p>
                <p class="text-gray-500 text-xs">Dikembangkan oleh KKN UNIB Periode 108 Kelompok 146</p>
            </div>
            <div>
                <h4 class="font-black text-sm mb-4 text-[#66BB6A]">LAYANAN</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('aspirasi') }}" class="hover:text-[#66BB6A] transition-colors">Aspirasi Masyarakat</a></li>
                    <li><a href="{{ route('dokumen') }}" class="hover:text-[#66BB6A] transition-colors">Dokumen Desa</a></li>
                    <li><a href="{{ route('sitara') }}" class="hover:text-[#66BB6A] transition-colors">SiTARA - Bank Sampah</a></li>
                    <li><a href="{{ route('peta') }}" class="hover:text-[#66BB6A] transition-colors">Peta Interaktif</a></li>
                    <li><a href="{{ route('kalender') }}" class="hover:text-[#66BB6A] transition-colors">Kalender Kegiatan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-sm mb-4 text-[#66BB6A]">KONTAK</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-center gap-2">📍 Jl. Raya Talang Marap No.1</li>
                    <li class="flex items-center gap-2">📞 <a href="https://wa.me/6281234567890" class="hover:text-[#66BB6A]">+62 812-3456-7890</a></li>
                    <li class="flex items-center gap-2">✉️ desatalangmarap@gmail.com</li>
                    <li class="flex items-center gap-2">🕐 Senin-Jumat 08.00-16.00</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-xs">
            © {{ date('Y') }} Portal Digital Desa Talang Marap. All rights reserved.
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
