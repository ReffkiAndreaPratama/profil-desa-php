@extends('layouts.public')

@section('title', 'Portal Digital Desa Talang Marap')

@section('content')
<!-- HERO -->
<section class="relative min-h-screen flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=1920')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>

    <div class="relative container-custom w-full pt-24 pb-20">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-[#2E7D32] border-2 border-white/30 text-white text-xs font-bold px-4 py-2 rounded-full mb-6">
                🌿 Portal Resmi Desa Digital
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-black text-white leading-tight mb-4">
                DESA<br><span class="text-[#66BB6A]">TALANG MARAP</span>
            </h1>
            <p class="text-white/80 text-base md:text-lg mb-2 font-medium">
                {{ $desa['kecamatan'] }} · {{ $desa['kabupaten'] }} · {{ $desa['provinsi'] }}
            </p>
            <p class="text-white/60 text-lg italic mb-8">"{{ $desa['tagline'] }}"</p>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
                @php
                $stats = [
                    ['icon'=>'👥','label'=>'Penduduk','value'=>$desa['jumlah_penduduk'] ?? '1.847'],
                    ['icon'=>'🏠','label'=>'KK','value'=>$desa['jumlah_kk'] ?? '512'],
                    ['icon'=>'🗺️','label'=>'Luas (km²)','value'=>'24.5'],
                    ['icon'=>'🏘️','label'=>'Dusun','value'=>$desa['jumlah_dusun'] ?? '4'],
                ];
                @endphp
                @foreach($stats as $stat)
                <div class="bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-2xl p-4 text-center">
                    <div class="text-2xl mb-1">{{ $stat['icon'] }}</div>
                    <p class="text-2xl font-black text-white">{{ $stat['value'] }}</p>
                    <p class="text-white/60 text-xs font-medium">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profil') }}" class="brutal-btn bg-[#2E7D32] text-white px-6 py-3 rounded-xl font-black flex items-center gap-2 text-sm">
                    Jelajahi Desa →
                </a>
                <a href="{{ route('wisata') }}" class="brutal-btn bg-white text-[#212121] px-6 py-3 rounded-xl font-black flex items-center gap-2 text-sm">
                    ▶ Lihat Potensi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- MARQUEE -->
<div class="bg-[#2E7D32] border-y-4 border-[#212121] py-3 overflow-hidden">
    <div class="marquee-wrapper">
        <div class="marquee-content">
            @php $announcements = ['📢 Musdes RPJMDes 2025-2031','🎓 KKN UNIB Periode 108 Kelompok 146','♻️ Launching SiTARA - Sistem Informasi Sampah','🌾 Festival Panen Raya Talang Marap','💻 Pelatihan Digital Marketing UMKM','🌿 Bank Sampah Desa resmi beroperasi','📱 Portal Digital Desa Talang Marap live!']; @endphp
            @foreach(array_merge($announcements, $announcements) as $a)
            <span class="text-white font-bold text-sm mx-6">{{ $a }} <span class="text-[#81C784] mx-4">•</span></span>
            @endforeach
        </div>
    </div>
</div>

<!-- QUICK ACCESS -->
<section class="py-16 md:py-20">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32] text-xs font-black px-4 py-1 rounded-full mb-3">MENU CEPAT</span>
            <h2 class="text-3xl md:text-4xl font-black text-[#212121]">Akses <span class="text-gradient">Layanan Desa</span></h2>
            <p class="text-gray-500 mt-2">Semua informasi dan layanan desa dalam satu portal</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            @php
            $links = [
                ['icon'=>'👥','label'=>'Profil Desa','route'=>'profil','color'=>'#2E7D32','bg'=>'#E8F5E9'],
                ['icon'=>'📰','label'=>'Berita','route'=>'berita','color'=>'#1565C0','bg'=>'#E3F2FD'],
                ['icon'=>'⛰️','label'=>'Wisata','route'=>'wisata','color'=>'#E65100','bg'=>'#FFF3E0'],
                ['icon'=>'🛍️','label'=>'UMKM','route'=>'umkm','color'=>'#6A1B9A','bg'=>'#F3E5F5'],
                ['icon'=>'🖼️','label'=>'Galeri','route'=>'galeri','color'=>'#00695C','bg'=>'#E0F2F1'],
                ['icon'=>'🗺️','label'=>'Peta','route'=>'peta','color'=>'#C62828','bg'=>'#FFEBEE'],
                ['icon'=>'♻️','label'=>'SiTARA','route'=>'sitara','color'=>'#2E7D32','bg'=>'#E8F5E9'],
                ['icon'=>'🎓','label'=>'KKN','route'=>'kkn','color'=>'#F57F17','bg'=>'#FFFDE7'],
                ['icon'=>'📞','label'=>'Kontak','route'=>'kontak','color'=>'#880E4F','bg'=>'#FCE4EC'],
                ['icon'=>'📊','label'=>'Data Statistik','route'=>'data','color'=>'#1B5E20','bg'=>'#E8F5E9'],
            ];
            @endphp
            @foreach($links as $link)
            <a href="{{ route($link['route']) }}" class="group brutal-card p-5 flex flex-col items-center gap-3 text-center transition-all">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl transition-all group-hover:scale-110"
                     style="background-color:{{ $link['bg'] }}">
                    {{ $link['icon'] }}
                </div>
                <span class="font-bold text-sm text-[#212121]">{{ $link['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- BERITA TERBARU -->
@if($berita->count() > 0)
<section class="py-16 md:py-20 bg-[#F1F8E9]">
    <div class="container-custom">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32] text-xs font-black px-4 py-1 rounded-full mb-2">BERITA TERKINI</span>
                <h2 class="text-3xl font-black text-[#212121]">Kabar <span class="text-gradient">Desa</span></h2>
            </div>
            <a href="{{ route('berita') }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm hidden md:flex items-center gap-2">
                Semua Berita →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($berita as $b)
            <a href="{{ route('berita.detail', $b->id) }}" class="brutal-card overflow-hidden group">
                <div class="overflow-hidden h-48">
                    <img src="{{ $b->foto ?? 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=600' }}"
                         alt="{{ $b->judul }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"/>
                </div>
                <div class="p-5">
                    <span class="inline-block bg-[#E8F5E9] text-[#2E7D32] text-xs font-bold px-2 py-1 rounded-full border border-[#2E7D32] mb-2">{{ $b->kategori }}</span>
                    <h3 class="font-black text-[#212121] text-base leading-tight mb-2 line-clamp-2">{{ $b->judul }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $b->ringkasan }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span>📅 {{ $b->tanggal->format('d M Y') }}</span>
                        <span>👁 {{ $b->views }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-6 md:hidden">
            <a href="{{ route('berita') }}" class="brutal-btn bg-[#2E7D32] text-white px-6 py-3 rounded-xl font-bold inline-flex items-center gap-2">
                Semua Berita →
            </a>
        </div>
    </div>
</section>
@endif

<!-- AGENDA & STATISTIK -->
<section class="py-16 md:py-20">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Agenda -->
            <div>
                <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32] text-xs font-black px-4 py-1 rounded-full mb-3">AGENDA</span>
                <h2 class="text-3xl font-black text-[#212121] mb-6">Kegiatan <span class="text-gradient">Mendatang</span></h2>
                <div class="space-y-3">
                    @forelse($agenda as $ag)
                    <div class="brutal-card p-4 flex items-center gap-4">
                        <div class="bg-[#2E7D32] text-white w-14 h-14 rounded-xl flex flex-col items-center justify-center shrink-0 border-2 border-[#212121]">
                            <span class="font-black text-lg leading-none">{{ $ag->tanggal->format('d') }}</span>
                            <span class="text-[10px] font-bold">{{ $ag->tanggal->format('M') }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-black text-sm">{{ $ag->judul }}</p>
                            <p class="text-gray-500 text-xs mt-1">⏰ {{ $ag->jam }} · 📍 {{ $ag->lokasi }}</p>
                        </div>
                        <span class="text-xs bg-[#E8F5E9] border border-[#2E7D32] text-[#2E7D32] px-2 py-1 rounded-full font-semibold shrink-0">{{ $ag->kategori }}</span>
                    </div>
                    @empty
                    <div class="brutal-card p-8 text-center text-gray-400">
                        <p class="text-3xl mb-2">📅</p>
                        <p>Belum ada agenda</p>
                    </div>
                    @endforelse
                </div>
                <a href="{{ route('kalender') }}" class="mt-4 inline-flex items-center gap-2 font-bold text-[#2E7D32] text-sm">
                    Lihat Kalender Lengkap →
                </a>
            </div>

            <!-- Statistik -->
            <div>
                <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32] text-xs font-black px-4 py-1 rounded-full mb-3">STATISTIK</span>
                <h2 class="text-3xl font-black text-[#212121] mb-6">Data <span class="text-gradient">Desa</span></h2>
                <div class="grid grid-cols-2 gap-4">
                    @php
                    $statItems = [
                        ['label'=>'Total Penduduk','value'=>$desa['jumlah_penduduk'] ?? '1.847','icon'=>'👥','trend'=>'+2.3%'],
                        ['label'=>'Kepala Keluarga','value'=>$desa['jumlah_kk'] ?? '512','icon'=>'🏠','trend'=>'+1.8%'],
                        ['label'=>'UMKM Aktif','value'=>$statistik->umkm ?? 32,'icon'=>'🛍️','trend'=>'+5.1%'],
                        ['label'=>'Wisatawan/Bulan','value'=>'1.200+','icon'=>'🏞️','trend'=>'+12%'],
                    ];
                    @endphp
                    @foreach($statItems as $s)
                    <div class="brutal-card p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-2xl">{{ $s['icon'] }}</span>
                            <span class="text-xs font-bold text-green-600">📈 {{ $s['trend'] }}</span>
                        </div>
                        <p class="font-black text-xl text-[#2E7D32]">{{ $s['value'] }}</p>
                        <p class="text-gray-500 text-xs font-medium">{{ $s['label'] }}</p>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('data') }}" class="mt-4 inline-flex items-center gap-2 font-bold text-[#2E7D32] text-sm">
                    Dashboard Statistik Lengkap →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA ASPIRASI -->
<section class="py-16 md:py-20">
    <div class="container-custom">
        <div class="brutal-card bg-gradient-to-br from-[#2E7D32] to-[#43A047] p-8 md:p-12 text-center text-white border-[#212121]">
            <div class="text-5xl mb-4">💬</div>
            <h2 class="text-3xl font-black mb-3">Suarakan Aspirasimu!</h2>
            <p class="text-white/80 mb-6 max-w-lg mx-auto">Ada saran, keluhan, atau ide untuk kemajuan desa? Sampaikan aspirasi Anda langsung kepada perangkat desa.</p>
            <a href="{{ route('aspirasi') }}" class="brutal-btn bg-white text-[#212121] px-8 py-3 rounded-xl font-black inline-flex items-center gap-2">
                Kirim Aspirasi →
            </a>
        </div>
    </div>
</section>
@endsection
