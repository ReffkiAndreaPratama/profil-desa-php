@extends('layouts.public')
@section('title', 'Aspirasi Masyarakat')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom">
            <h1 class="text-3xl font-black text-white mb-1">Aspirasi Masyarakat</h1>
            <p class="text-white/70">Sampaikan aspirasi, saran, atau keluhan Anda</p>
        </div>
    </div>
    <div class="container-custom py-10 max-w-2xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-2 border-green-500 rounded-xl text-green-800 font-semibold">✅ {{ session('success') }}</div>
        @endif
        <div class="brutal-card p-8">
            <h2 class="font-black text-xl mb-6">📝 Kirim Aspirasi</h2>
            <form action="{{ route('aspirasi.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div class="flex items-center gap-3 p-4 bg-[#F1F8E9] rounded-xl border-2 border-[#2E7D32]">
                    <input type="checkbox" name="anonim" id="anonim" value="1" {{ old('anonim') ? 'checked' : '' }}
                           class="w-4 h-4" onchange="document.getElementById('namaField').classList.toggle('hidden', this.checked)"/>
                    <label for="anonim" class="font-bold text-sm cursor-pointer">Kirim sebagai anonim</label>
                </div>
                <div id="namaField" {{ old('anonim') ? 'style=display:none' : '' }}>
                    <label class="block font-bold text-sm mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Anda"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] @error('nama') border-red-500 @enderror"/>
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kategori *</label>
                    <select name="kategori" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                        @foreach(['Infrastruktur','Pendidikan','Kesehatan','Pertanian','Lingkungan','Sosial','Ekonomi','Lainnya'] as $k)
                        <option value="{{ $k }}" {{ old('kategori') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Pesan Aspirasi *</label>
                    <textarea name="pesan" rows="6" placeholder="Tuliskan aspirasi, saran, atau keluhan Anda di sini..."
                              class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none @error('pesan') border-red-500 @enderror">{{ old('pesan') }}</textarea>
                    @error('pesan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full brutal-btn bg-[#2E7D32] text-white py-3 rounded-xl font-black text-base">
                    Kirim Aspirasi →
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
