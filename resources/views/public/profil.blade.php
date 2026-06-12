@extends('layouts.public')
@section('title', 'Profil Desa - Portal Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-12">
        <div class="container-custom">
            <div class="text-white">
                <p class="text-white/60 text-sm mb-3">Beranda › Profil Desa</p>
                <h1 class="text-4xl font-black mb-2">Profil Desa Talang Marap</h1>
                <p class="text-white/80">{{ $desa['kecamatan'] }} · {{ $desa['kabupaten'] }} · {{ $desa['provinsi'] }}</p>
            </div>
        </div>
    </div>

    <div class="container-custom py-8">
        <!-- Info Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="brutal-card p-4 flex items-center gap-3"><span class="text-2xl">📍</span><div><p class="text-xs text-gray-400">Lokasi</p><p class="font-bold text-sm">{{ $desa['kecamatan'] }}</p></div></div>
            <div class="brutal-card p-4 flex items-center gap-3"><span class="text-2xl">📞</span><div><p class="text-xs text-gray-400">WhatsApp</p><p class="font-bold text-sm">+62 {{ substr($desa['whatsapp'] ?? '', 2) }}</p></div></div>
            <div class="brutal-card p-4 flex items-center gap-3"><span class="text-2xl">✉️</span><div><p class="text-xs text-gray-400">Email</p><p class="font-bold text-sm truncate">{{ $desa['email'] }}</p></div></div>
            <div class="brutal-card p-4 flex items-center gap-3"><span class="text-2xl">🗺️</span><div><p class="text-xs text-gray-400">Luas Wilayah</p><p class="font-bold text-sm">{{ $desa['luas_wilayah'] ?? '24.5 km²' }}</p></div></div>
        </div>

        <!-- Tabs -->
        <div x-data="{ tab: 'sejarah' }" x-cloak>
            <div class="flex gap-2 mb-8 overflow-x-auto pb-2">
                @foreach(['sejarah'=>'Sejarah','visi'=>'Visi & Misi','perangkat'=>'Perangkat Desa','demografi'=>'Demografi'] as $key=>$label)
                <button @click="tab='{{ $key }}'"
                    :class="tab==='{{ $key }}' ? 'bg-[#2E7D32] text-white' : 'bg-white text-[#212121]'"
                    class="brutal-btn px-5 py-2.5 rounded-xl font-bold text-sm whitespace-nowrap flex-shrink-0">{{ $label }}</button>
                @endforeach
            </div>

            <!-- Sejarah -->
            <div x-show="tab==='sejarah'" class="fade-in">
                <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32] text-xs font-black px-4 py-1 rounded-full mb-3">SEJARAH</span>
                <h2 class="text-3xl font-black mb-8">Perjalanan Desa <span class="text-gradient">Talang Marap</span></h2>
                <div class="relative">
                    <div class="absolute left-8 top-0 bottom-0 w-1 bg-[#2E7D32] rounded-full"></div>
                    <div class="space-y-6">
                        @php
                        $timeline = [
                            ['tahun'=>'1945','judul'=>'Berdirinya Desa','desc'=>'Desa Talang Marap resmi berdiri sebagai wilayah administratif setelah kemerdekaan Indonesia.'],
                            ['tahun'=>'1970','judul'=>'Pembangunan Balai Desa','desc'=>'Dibangun balai desa pertama sebagai pusat kegiatan pemerintahan dan masyarakat.'],
                            ['tahun'=>'1985','judul'=>'Pengembangan Pertanian','desc'=>'Program intensifikasi pertanian berhasil meningkatkan produksi padi dan kopi secara signifikan.'],
                            ['tahun'=>'2010','judul'=>'Listrik Masuk Desa','desc'=>'Seluruh wilayah desa kini teraliri listrik PLN, meningkatkan taraf hidup warga.'],
                            ['tahun'=>'2025','judul'=>'Era Digital Desa','desc'=>'Launching Portal Digital Desa dan SiTARA sebagai tonggak digitalisasi desa bersama KKN UNIB.'],
                        ];
                        @endphp
                        @foreach($timeline as $t)
                        <div class="relative flex gap-6 items-start">
                            <div class="w-16 h-16 rounded-2xl bg-[#2E7D32] border-4 border-[#212121] shadow-[4px_4px_0_#212121] flex flex-col items-center justify-center shrink-0 z-10">
                                <span class="text-white font-black text-xs text-center">{{ $t['tahun'] }}</span>
                            </div>
                            <div class="brutal-card p-5 flex-1 mt-1">
                                <h3 class="font-black text-base mb-1">{{ $t['judul'] }}</h3>
                                <p class="text-gray-500 text-sm">{{ $t['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Visi Misi -->
            <div x-show="tab==='visi'" class="space-y-6">
                <div class="brutal-card bg-gradient-to-br from-[#2E7D32] to-[#43A047] p-8 text-white">
                    <h3 class="font-black text-xl mb-4">👁 Visi Desa</h3>
                    <p class="text-white/90 text-lg font-semibold italic">"Terwujudnya Desa Talang Marap yang Maju, Mandiri, Sejahtera, dan Berdaya Saing Berbasis Potensi Lokal dan Teknologi"</p>
                </div>
                <div class="brutal-card p-8">
                    <h3 class="font-black text-xl mb-6">🎯 Misi Desa</h3>
                    <div class="space-y-4">
                        @php $misi = ['Meningkatkan kualitas SDM melalui pendidikan dan pelatihan','Mengembangkan ekonomi lokal berbasis pertanian, UMKM, dan wisata desa','Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel','Meningkatkan infrastruktur dan fasilitas pelayanan publik','Melestarikan lingkungan hidup dan budaya lokal','Mendorong digitalisasi dan pemanfaatan teknologi informasi']; @endphp
                        @foreach($misi as $i => $m)
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-[#2E7D32] text-white flex items-center justify-center shrink-0 font-black text-sm border-2 border-[#212121]">{{ $i+1 }}</div>
                            <p class="text-gray-600 font-medium pt-1">{{ $m }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Perangkat Desa -->
            <div x-show="tab==='perangkat'">
                <h2 class="text-3xl font-black mb-8">Struktur <span class="text-gradient">Pemerintahan</span></h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                    @foreach($perangkat as $p)
                    <div class="brutal-card p-5 text-center">
                        <img src="{{ $p->foto ?? 'https://ui-avatars.com/api/?name='.urlencode($p->nama).'&background=2E7D32&color=fff&size=200' }}"
                             alt="{{ $p->nama }}" class="w-20 h-20 rounded-full mx-auto mb-3 border-4 border-[#2E7D32] shadow-[3px_3px_0_#212121]"/>
                        <p class="font-black text-sm text-[#212121]">{{ $p->nama }}</p>
                        <p class="text-[#2E7D32] text-xs font-bold mt-1">{{ $p->jabatan }}</p>
                        @if($p->kontak)
                        <a href="https://wa.me/62{{ ltrim($p->kontak,'0') }}" class="text-xs text-gray-400 hover:text-[#2E7D32] mt-1 block">📞 {{ $p->kontak }}</a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Demografi -->
            <div x-show="tab==='demografi'">
                <h2 class="text-3xl font-black mb-8">Data <span class="text-gradient">Kependudukan</span></h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="brutal-card p-5 text-center"><p class="text-2xl font-black text-[#2E7D32]">{{ $statistik->penduduk ?? 1847 }}</p><p class="text-gray-500 text-sm">Total Penduduk</p></div>
                    <div class="brutal-card p-5 text-center"><p class="text-2xl font-black text-blue-700">{{ $statistik->laki_laki ?? 921 }}</p><p class="text-gray-500 text-sm">Laki-laki</p></div>
                    <div class="brutal-card p-5 text-center"><p class="text-2xl font-black text-pink-700">{{ $statistik->perempuan ?? 926 }}</p><p class="text-gray-500 text-sm">Perempuan</p></div>
                    <div class="brutal-card p-5 text-center"><p class="text-2xl font-black text-orange-700">{{ $statistik->kk ?? 512 }}</p><p class="text-gray-500 text-sm">Kepala Keluarga</p></div>
                </div>
                <div class="brutal-card p-6">
                    <h3 class="font-black mb-4">Mata Pencaharian Utama</h3>
                    @php
                    $pekerjaan = [['label'=>'Petani','value'=>487,'pct'=>26],['label'=>'Pelajar/Mahasiswa','value'=>312,'pct'=>17],['label'=>'Ibu Rumah Tangga','value'=>298,'pct'=>16],['label'=>'Swasta','value'=>198,'pct'=>11],['label'=>'Pedagang','value'=>124,'pct'=>7]];
                    @endphp
                    <div class="space-y-3">
                        @foreach($pekerjaan as $p)
                        <div>
                            <div class="flex justify-between text-sm font-medium mb-1"><span>{{ $p['label'] }}</span><span class="text-[#2E7D32] font-bold">{{ $p['value'] }} jiwa</span></div>
                            <div class="h-3 bg-gray-200 rounded-full border-2 border-[#212121] overflow-hidden"><div class="h-full bg-[#2E7D32] rounded-full" style="width:{{ $p['pct'] }}%"></div></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection
