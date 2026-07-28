@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')

@section('content')

<div class="max-w-2xl">

    <a href="{{ route('admin.pesan-kontak.index') }}"
       class="text-sm font-bold text-[#2E7D32] mb-4 inline-block">
        ← Kembali
    </a>

    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-6">

        {{-- ── Sender info ── --}}
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-[#E8F5E9] rounded-xl flex items-center justify-center text-xl">
                ✉️
            </div>
            <div>
                <p class="font-black">{{ $pesan->nama }}</p>
                <p class="text-sm text-gray-400">
                    {{ $pesan->email }}
                    @if($pesan->telepon) · {{ $pesan->telepon }} @endif
                </p>
            </div>
        </div>

        {{-- ── Subject & message ── --}}
        @if($pesan->subjek)
            <p class="font-bold text-sm text-[#2E7D32] mb-2">Subjek: {{ $pesan->subjek }}</p>
        @endif

        <p class="text-gray-700 leading-relaxed">{{ $pesan->pesan }}</p>

        <p class="text-gray-400 text-xs mt-4">
            Dikirim: {{ $pesan->created_at->format('d M Y H:i') }}
        </p>

    </div>
</div>

@endsection
