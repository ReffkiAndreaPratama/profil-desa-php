@extends('layouts.admin')

@section('title', 'Verifikasi Email')
@section('page_title', 'Verifikasi Email')

@section('content')
<div class="max-w-xl mx-auto bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-8">
    <h2 class="text-2xl font-black mb-3">📧 Verifikasi Email Anda</h2>
    <p class="text-gray-600 mb-6">Silakan cek inbox email Anda untuk link verifikasi. Jika belum menerima, klik tombol kirim ulang di bawah.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-6 py-3 rounded-xl font-black">Kirim Ulang Link Verifikasi</button>
    </form>
</div>
@endsection
