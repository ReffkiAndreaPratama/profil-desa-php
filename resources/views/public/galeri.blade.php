@extends('layouts.public')

@section('title', 'Galeri - Smart Village Talang Marap')

@section('content')

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Page header ── --}}
    @include('layouts.partials.page-header', [
        'title'    => 'Galeri Foto',
        'subtitle' => 'Dokumentasi kegiatan dan pemandangan desa',
    ])

    <div class="container-custom py-8">

        {{-- ── Photo grid
             Note: clicking a card opens lightbox — wire up js/app.js to handle [data-lightbox]
        ── --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @forelse($galeri as $g)
                <div class="brutal-card overflow-hidden group cursor-pointer" data-lightbox="{{ $g->foto }}">

                    <div class="aspect-square overflow-hidden">
                        <img src="{{ \App\Helpers\FotoHelper::url($g->foto) }}"
                             alt="{{ $g->judul }}"
                             class="w-full h-full object-cover group-hover:scale-110
                                    transition-transform duration-300"/>
                    </div>

                    <div class="p-3">
                        <p class="font-bold text-xs truncate dark:text-gray-200">{{ $g->judul }}</p>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-[10px] bg-[#E8F5E9] text-[#2E7D32]
                                         px-2 py-0.5 rounded-full border border-[#66BB6A]">
                                {{ $g->kategori }}
                            </span>
                            <span class="text-[10px] text-gray-400">
                                {{ $g->tanggal->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-4 text-center py-20 text-gray-400">
                    <p class="text-5xl mb-4">🖼️</p>
                    <p>Belum ada foto</p>
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        <div class="mt-8">{{ $galeri->links() }}</div>

    </div>
</div>

@endsection
