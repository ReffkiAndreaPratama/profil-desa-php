@extends('layouts.public')

@section('title', 'Data Statistik Desa')

@section('content')

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Page header ── --}}
    @include('layouts.partials.page-header', [
        'title'    => 'Data Statistik',
        'subtitle' => 'Dashboard data kependudukan dan pembangunan',
    ])

    <div class="container-custom py-8">

        {{-- ── Kependudukan table ── --}}
        <h2 class="text-2xl font-black mb-6">📊 Data Kependudukan per Tahun</h2>

        <div class="brutal-card overflow-hidden mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#2E7D32] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Tahun</th>
                            <th class="px-4 py-3 text-center">Penduduk</th>
                            <th class="px-4 py-3 text-center">KK</th>
                            <th class="px-4 py-3 text-center">Laki-laki</th>
                            <th class="px-4 py-3 text-center">Perempuan</th>
                            <th class="px-4 py-3 text-center">UMKM</th>
                        </tr>
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
    </div>
</div>

@endsection
