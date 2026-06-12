@extends('layouts.public')
@section('title', 'UMKM Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom">
            <h1 class="text-3xl font-black text-white mb-1">UMKM Desa Talang Marap</h1>
            <p class="text-white/70">Produk unggulan dan usaha warga desa</p>
        </div>
    </div>
    <div class="container-custom py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($umkm as $u)
            <div class="brutal-card overflow-hidden">
                <div class="h-48 overflow-hidden">
                    <img src="{{ $u->foto ?? 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=400' }}" alt="{{ $u->nama }}" class="w-full h-full object-cover"/>
                </div>
                <div class="p-5">
                    <span class="inline-block bg-[#E8F5E9] text-[#2E7D32] text-xs font-bold px-2 py-1 rounded-full border border-[#2E7D32] mb-2">{{ $u->kategori }}</span>
                    <h3 class="font-black text-base mb-2">{{ $u->nama }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $u->deskripsi }}</p>
                    <div class="space-y-1 text-xs text-gray-500 mb-4">
                        <p>💰 <span class="font-bold text-[#2E7D32]">{{ $u->harga }}</span></p>
                        <p>👤 {{ $u->pemilik }} · 📍 {{ $u->lokasi }}</p>
                        <p>📦 Stok: {{ $u->stok }}</p>
                    </div>
                    @if($u->kontak)
                    <a href="https://wa.me/{{ $u->kontak }}" target="_blank" class="brutal-btn bg-green-500 text-white px-4 py-2 rounded-xl font-bold text-sm w-full text-center block">💬 Hubungi Penjual</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 text-gray-400">
                <p class="text-5xl mb-4">🛍️</p>
                <p class="font-bold">Belum ada UMKM</p>
            </div>
            @endforelse
        </div>
        <div class="mt-8">{{ $umkm->links() }}</div>
    </div>
</div>
@endsection
