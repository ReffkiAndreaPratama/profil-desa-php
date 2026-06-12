@extends('layouts.public')
@section('title', $berita->judul . ' - Portal Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="container-custom py-8 max-w-4xl">
        <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 font-bold text-[#2E7D32] hover:gap-3 transition-all mb-6 text-sm">
            ← Kembali ke Berita
        </a>
        <div class="brutal-card overflow-hidden">
            @if($berita->foto)
            <img src="{{ $berita->foto }}" alt="{{ $berita->judul }}" class="w-full h-64 md:h-80 object-cover"/>
            @endif
            <div class="p-6 md:p-8">
                <span class="inline-block bg-[#E8F5E9] text-[#2E7D32] text-xs font-bold px-3 py-1 rounded-full border border-[#2E7D32] mb-4">
                    {{ $berita->kategori }}
                </span>
                <h1 class="text-2xl md:text-3xl font-black text-[#212121] mb-4">{{ $berita->judul }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                    <span>✍️ {{ $berita->penulis }}</span>
                    <span>📅 {{ $berita->tanggal->translatedFormat('d F Y') }}</span>
                    <span>👁 {{ $berita->views }} views</span>
                </div>
                @if($berita->ringkasan)
                <p class="text-gray-700 leading-relaxed text-base mb-4 font-medium italic border-l-4 border-[#2E7D32] pl-4">{{ $berita->ringkasan }}</p>
                @endif
                <div class="text-gray-600 leading-relaxed text-base whitespace-pre-line">{{ $berita->konten }}</div>

                <!-- Share -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap items-center gap-3">
                    <span class="font-bold text-sm">📤 Bagikan:</span>
                    @php $url = urlencode(request()->url()); $title = urlencode($berita->judul); @endphp
                    <a href="https://wa.me/?text={{ $title }}%20{{ $url }}" target="_blank"
                       class="brutal-btn text-xs px-3 py-1.5 rounded-lg bg-green-100 text-green-700 hover:bg-green-600 hover:text-white transition-colors">WhatsApp</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank"
                       class="brutal-btn text-xs px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white transition-colors">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank"
                       class="brutal-btn text-xs px-3 py-1.5 rounded-lg bg-sky-100 text-sky-700 hover:bg-sky-500 hover:text-white transition-colors">Twitter</a>
                </div>
            </div>
        </div>

        @if($related->count() > 0)
        <h2 class="font-black text-xl mt-10 mb-4">Berita Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($related as $r)
            <a href="{{ route('berita.detail', $r->id) }}" class="brutal-card overflow-hidden group">
                @if($r->foto)
                <img src="{{ $r->foto }}" alt="{{ $r->judul }}" class="w-full h-32 object-cover group-hover:scale-105 transition-transform"/>
                @endif
                <div class="p-4">
                    <p class="font-bold text-sm line-clamp-2">{{ $r->judul }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $r->tanggal->format('d M Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
