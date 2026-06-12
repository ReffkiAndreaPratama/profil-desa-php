@extends('layouts.public')
@section('title', 'Kalender Kegiatan')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">Kalender Kegiatan</h1><p class="text-white/70">Agenda desa dan jadwal kegiatan</p></div>
    </div>
    <div class="container-custom py-8">
        <div class="space-y-4">
            @forelse($agenda as $ag)
            <div class="brutal-card p-5 flex items-center gap-4">
                <div class="bg-[#2E7D32] text-white w-16 h-16 rounded-xl flex flex-col items-center justify-center shrink-0 border-2 border-[#212121]">
                    <span class="font-black text-xl leading-none">{{ $ag->tanggal->format('d') }}</span>
                    <span class="text-xs font-bold">{{ $ag->tanggal->format('M') }}</span>
                    <span class="text-[9px]">{{ $ag->tanggal->format('Y') }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-black text-base">{{ $ag->judul }}</h3>
                    <p class="text-gray-500 text-sm mt-1">⏰ {{ $ag->jam }} · 📍 {{ $ag->lokasi }}</p>
                    @if($ag->deskripsi)<p class="text-gray-400 text-xs mt-1">{{ $ag->deskripsi }}</p>@endif
                </div>
                <span class="text-xs bg-[#E8F5E9] border border-[#2E7D32] text-[#2E7D32] px-3 py-1 rounded-full font-semibold shrink-0 hidden sm:inline">{{ $ag->kategori }}</span>
            </div>
            @empty
            <div class="brutal-card p-12 text-center text-gray-400"><p class="text-5xl mb-4">📅</p><p class="font-bold">Belum ada agenda</p></div>
            @endforelse
        </div>
    </div>
</div>
@endsection
