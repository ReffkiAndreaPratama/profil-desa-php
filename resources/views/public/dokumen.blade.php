@extends('layouts.public')
@section('title', 'Dokumen Desa')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">Arsip Dokumen Desa</h1><p class="text-white/70">Akses dokumen resmi Desa Talang Marap</p></div>
    </div>
    <div class="container-custom py-8">
        <div class="brutal-card overflow-hidden">
            <div class="bg-[#2E7D32] p-4 text-white font-black flex items-center gap-2">📄 Daftar Dokumen ({{ $dokumen->count() }})</div>
            <div class="divide-y divide-gray-100">
                @forelse($dokumen as $doc)
                <div class="p-4 flex items-center gap-4 hover:bg-[#F1F8E9] transition-colors">
                    <div class="w-12 h-12 bg-red-100 border-2 border-red-300 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-red-600 font-black text-xs">{{ $doc->tipe ?? 'PDF' }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm">{{ $doc->nama }}</p>
                        <div class="flex items-center gap-3 text-xs text-gray-400 mt-1">
                            <span class="bg-[#E8F5E9] text-[#2E7D32] px-2 py-0.5 rounded-full border border-[#66BB6A] font-semibold">{{ $doc->kategori }}</span>
                            <span>📅 {{ $doc->tanggal ? $doc->tanggal->format('d M Y') : '-' }}</span>
                            @if($doc->ukuran)<span>📦 {{ $doc->ukuran }}</span>@endif
                        </div>
                    </div>
                    @if($doc->url)
                    <a href="{{ $doc->url }}" target="_blank" class="brutal-btn bg-[#2E7D32] text-white px-3 py-2 rounded-xl font-bold text-xs shrink-0">⬇️ Unduh</a>
                    @else
                    <span class="text-xs text-gray-400 italic shrink-0">Belum tersedia</span>
                    @endif
                </div>
                @empty
                <div class="p-12 text-center text-gray-400"><p class="text-4xl mb-2">📄</p><p>Belum ada dokumen</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
