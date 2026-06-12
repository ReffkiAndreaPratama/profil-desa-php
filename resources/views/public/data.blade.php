@extends('layouts.public')
@section('title', 'Data Statistik Desa')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">Data Statistik</h1><p class="text-white/70">Dashboard data kependudukan dan pembangunan</p></div>
    </div>
    <div class="container-custom py-8">
        <!-- Data Kependudukan Tahunan -->
        <h2 class="text-2xl font-black mb-6">📊 Data Kependudukan per Tahun</h2>
        <div class="brutal-card overflow-hidden mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#2E7D32] text-white">
                        <tr><th class="px-4 py-3 text-left">Tahun</th><th class="px-4 py-3">Penduduk</th><th class="px-4 py-3">KK</th><th class="px-4 py-3">Laki-laki</th><th class="px-4 py-3">Perempuan</th><th class="px-4 py-3">UMKM</th></tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($statistik as $s)
                        <tr class="hover:bg-[#F1F8E9]">
                            <td class="px-4 py-3 font-black">{{ $s->tahun }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($s->penduduk) }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($s->kk) }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($s->laki_laki) }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($s->perempuan) }}</td>
                            <td class="px-4 py-3 text-center">{{ $s->umkm }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Data Sampah -->
        <h2 class="text-2xl font-black mb-6">♻️ Data Sampah Bulanan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($sampah as $ds)
            <div class="brutal-card p-5">
                <p class="font-black text-sm text-[#2E7D32] mb-3">{{ \Carbon\Carbon::parse($ds->bulan.'-01')->translatedFormat('F Y') }}</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Total</span><span class="font-bold">{{ number_format($ds->total) }} kg</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Organik</span><span class="font-bold text-green-600">{{ number_format($ds->organik) }} kg</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Anorganik</span><span class="font-bold text-blue-600">{{ number_format($ds->anorganik) }} kg</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">B3</span><span class="font-bold text-red-600">{{ number_format($ds->b3) }} kg</span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
