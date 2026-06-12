@extends('layouts.public')
@section('title', 'SiTARA - Sistem Informasi Sampah')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="bg-[#212121] border-b-4 border-[#2E7D32] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">♻️ SiTARA</h1><p class="text-[#66BB6A]">Sistem Informasi Sampah Talang Marap</p></div>
    </div>
    <div class="container-custom py-8">
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="brutal-card p-4 text-center"><p class="text-3xl">♻️</p><p class="font-black text-xl text-[#2E7D32]">{{ $sampah->total ?? 0 }} kg</p><p class="text-gray-500 text-xs">Total Sampah/Bulan</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-3xl">🌿</p><p class="font-black text-xl text-[#2E7D32]">{{ $sampah->organik ?? 0 }} kg</p><p class="text-gray-500 text-xs">Organik</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-3xl">📦</p><p class="font-black text-xl text-[#2E7D32]">{{ $sampah->anorganik ?? 0 }} kg</p><p class="text-gray-500 text-xs">Anorganik</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-3xl">🏆</p><p class="font-black text-xl text-[#2E7D32]">{{ $nasabah->count() }}</p><p class="text-gray-500 text-xs">Nasabah Aktif</p></div>
        </div>
        <!-- Leaderboard -->
        <h2 class="text-2xl font-black mb-6">🏆 Leaderboard <span class="text-gradient">Bank Sampah</span></h2>
        <div class="brutal-card overflow-hidden mb-8">
            <div class="bg-[#2E7D32] p-4 text-white font-black">Top Nasabah</div>
            <div class="divide-y divide-gray-100">
                @foreach($nasabah as $i => $n)
                <div class="p-4 flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full {{ $i < 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center font-black text-sm shrink-0">{{ $i+1 }}</div>
                    <div class="flex-1"><p class="font-bold text-sm">{{ $n->nama }}</p></div>
                    <span class="font-black text-[#2E7D32]">{{ number_format($n->poin) }} poin</span>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Lapor -->
        <div class="brutal-card p-8 bg-[#F1F8E9]">
            <h3 class="font-black text-xl mb-4">⚠️ Lapor Sampah Ilegal</h3>
            @if(session('success'))<div class="mb-4 p-3 bg-green-100 border-2 border-green-500 rounded-xl text-green-800 font-semibold text-sm">✅ {{ session('success') }}</div>@endif
            <form action="{{ route('laporan.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="nama" placeholder="Nama pelapor" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                <input type="text" name="lokasi" placeholder="Lokasi sampah" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsi masalah..." required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none"></textarea>
                <button type="submit" class="brutal-btn bg-red-500 text-white px-6 py-3 rounded-xl font-black">🚨 Kirim Laporan</button>
            </form>
        </div>
    </div>
</div>
@endsection
