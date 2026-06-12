@extends('layouts.public')
@section('title', 'Berita Desa - Portal Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom flex items-end justify-between">
            <div>
                <h1 class="text-3xl font-black text-white mb-1">Berita Desa</h1>
                <p class="text-white/70">Informasi terkini dari Desa Talang Marap</p>
            </div>
            <span class="text-white/60 text-sm font-bold hidden md:block">{{ $berita->total() }} artikel</span>
        </div>
    </div>

    <div class="container-custom py-8">
        <!-- Filter -->
        <form method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                class="flex-1 px-4 py-3 border-[3px] border-[#212121] rounded-xl font-medium outline-none focus:border-[#2E7D32] bg-white shadow-[3px_3px_0_#212121]"/>
            <div class="flex gap-2 flex-wrap">
                @php $kategoris = ['Semua','Pemerintahan','KKN','Lingkungan','Pertanian','Kesehatan','UMKM','Pendidikan']; @endphp
                @foreach($kategoris as $k)
                <button type="submit" name="kategori" value="{{ $k }}"
                    class="brutal-btn px-4 py-2 rounded-xl font-bold text-sm {{ request('kategori', 'Semua') === $k ? 'bg-[#2E7D32] text-white' : 'bg-white text-[#212121]' }}">
                    {{ $k }}
                </button>
                @endforeach
            </div>
        </form>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($berita as $b)
            <a href="{{ route('berita.detail', $b->id) }}" class="brutal-card overflow-hidden group">
                <div class="overflow-hidden h-44">
                    <img src="{{ $b->foto ?? 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=600' }}"
                         alt="{{ $b->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                </div>
                <div class="p-5">
                    <span class="inline-block bg-[#E8F5E9] text-[#2E7D32] text-xs font-bold px-2 py-1 rounded-full border border-[#2E7D32] mb-2">{{ $b->kategori }}</span>
                    <h3 class="font-black text-sm text-[#212121] line-clamp-2 mb-2">{{ $b->judul }}</h3>
                    <p class="text-gray-500 text-xs line-clamp-2 mb-3">{{ $b->ringkasan }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span>📅 {{ $b->tanggal->format('d M Y') }}</span>
                        <span>👁 {{ $b->views }}</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-20 text-gray-400">
                <p class="text-5xl mb-4">📰</p>
                <p class="font-bold text-lg">Tidak ada berita ditemukan</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">{{ $berita->links() }}</div>
    </div>
</div>
@endsection
