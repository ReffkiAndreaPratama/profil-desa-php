@extends('layouts.public')
@section('title', 'KKN UNIB - Portal Desa Talang Marap')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">KKN UNIB Periode 108</h1><p class="text-white/70">Kelompok 146 · Desa Talang Marap</p></div>
    </div>
    <div class="container-custom py-8">
        <!-- Tim -->
        <h2 class="text-2xl font-black mb-6">Tim <span class="text-gradient">Kami</span></h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mb-12">
            @foreach($anggota as $a)
            <div class="brutal-card p-4 text-center">
                <img src="{{ $a->foto ?? 'https://ui-avatars.com/api/?name='.urlencode($a->nama).'&background=2E7D32&color=fff&size=200' }}" alt="{{ $a->nama }}" class="w-16 h-16 rounded-full mx-auto mb-2 border-4 border-[#2E7D32]"/>
                <p class="font-black text-xs">{{ $a->nama }}</p>
                <p class="text-[#2E7D32] text-[10px] font-bold">{{ $a->posisi }}</p>
                <p class="text-gray-400 text-[10px]">{{ $a->prodi }}</p>
            </div>
            @endforeach
        </div>
        <!-- Proker -->
        <h2 class="text-2xl font-black mb-6">Program <span class="text-gradient">Kerja</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($proker as $p)
            <div class="brutal-card p-6">
                <div class="text-4xl mb-3">{{ $p->icon ?? '📋' }}</div>
                <h3 class="font-black text-base mb-2">{{ $p->nama }}</h3>
                <p class="text-gray-500 text-sm mb-4">{{ $p->deskripsi }}</p>
                <div class="flex items-center justify-between text-xs font-bold mb-1"><span>Progress</span><span class="text-[#2E7D32]">{{ $p->progress }}%</span></div>
                <div class="h-3 bg-gray-200 rounded-full border-2 border-[#212121] overflow-hidden"><div class="h-full bg-[#2E7D32] rounded-full" style="width:{{ $p->progress }}%"></div></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
