@extends('layouts.public')
@section('title', 'Wisata Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom">
            <h1 class="text-3xl font-black text-white mb-1">Wisata Desa Talang Marap</h1>
            <p class="text-white/70">Jelajahi keindahan alam dan budaya desa</p>
        </div>
    </div>
    <div class="container-custom py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @foreach([['🏞️','Destinasi','4'],['⭐','Rating','4.7'],['👥','Pengunjung/Bln','1.2K+'],['💰','Mulai','Rp 5.000']] as $s)
            <div class="brutal-card p-4 text-center">
                <span class="text-3xl">{{ $s[0] }}</span>
                <p class="font-black text-xl text-[#2E7D32] mt-1">{{ $s[2] }}</p>
                <p class="text-gray-500 text-xs">{{ $s[1] }}</p>
            </div>
            @endforeach
        </div>
        <h2 class="text-2xl font-black mb-6">Destinasi <span class="text-gradient">Unggulan</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            @foreach($wisata as $w)
            <div class="brutal-card overflow-hidden">
                <div class="relative h-52">
                    <img src="{{ $w->foto }}" alt="{{ $w->nama }}" class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4">
                        <span class="bg-[#2E7D32] text-white text-xs font-bold px-2 py-1 rounded-full">{{ $w->kategori }}</span>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 rounded-xl px-3 py-1 flex items-center gap-1">
                        <span class="text-yellow-500">⭐</span>
                        <span class="font-black text-sm">{{ $w->rating }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-black text-lg">{{ $w->nama }}</h3>
                        <span class="text-[#2E7D32] font-black text-sm bg-[#E8F5E9] px-2 py-1 rounded-lg border border-[#2E7D32]">{{ $w->harga }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">{{ $w->deskripsi }}</p>
                    <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
                        <span>🕐 {{ $w->jam_operasional }}</span>
                        <span>👥 {{ $w->pengunjung }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($w->fasilitas ?? [] as $f)
                        <span class="text-xs bg-[#E8F5E9] text-[#2E7D32] px-2 py-1 rounded-full border border-[#66BB6A]">✓ {{ $f }}</span>
                        @endforeach
                    </div>
                    @if($w->maps)
                    <a href="{{ $w->maps }}" target="_blank" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm inline-flex items-center gap-2">
                        🗺️ Buka di Maps
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <!-- CTA -->
        <div class="brutal-card bg-[#2E7D32] p-8 text-center text-white border-[#212121]">
            <h3 class="text-2xl font-black mb-2">Rencanakan Kunjungan Anda</h3>
            <p class="text-white/80 mb-4">Hubungi kami untuk informasi lebih lanjut</p>
            <a href="https://wa.me/{{ $desa['whatsapp'] ?? '6281234567890' }}" target="_blank" class="brutal-btn bg-white text-[#212121] px-6 py-3 rounded-xl font-black inline-flex items-center gap-2">📞 Hubungi via WhatsApp</a>
        </div>
    </div>
</div>
@endsection
