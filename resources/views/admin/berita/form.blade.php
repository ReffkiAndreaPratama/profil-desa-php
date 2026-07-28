@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
@section('page_title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')

@php
$kategoriList = ['Pemerintahan', 'KKN', 'Lingkungan', 'Pertanian', 'Kesehatan', 'UMKM', 'Pendidikan', 'Sosial'];
@endphp

<div class="max-w-3xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">
                📰 {{ isset($berita) ? 'Edit' : 'Tambah' }} Berita
            </h3>
        </div>

        <form action="{{ isset($berita) ? route('admin.berita.update', $berita->id) : route('admin.berita.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($berita))
                @method('PUT')
            @endif

            {{-- Judul --}}
            <div>
                <label class="block font-bold text-sm mb-2">Judul Berita *</label>
                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul', $berita->judul ?? '') }}"
                    required
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                           outline-none focus:border-[#2E7D32]
                           @error('judul') border-red-500 @enderror"/>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori & Tanggal --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Kategori *</label>
                    <select
                        name="kategori"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32] bg-white">
                        @foreach($kategoriList as $k)
                            <option value="{{ $k }}"
                                    {{ old('kategori', $berita->kategori ?? '') === $k ? 'selected' : '' }}>
                                {{ $k }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Tanggal *</label>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal', isset($berita) ? $berita->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            {{-- Penulis --}}
            <div>
                <label class="block font-bold text-sm mb-2">Penulis *</label>
                <input
                    type="text"
                    name="penulis"
                    value="{{ old('penulis', $berita->penulis ?? 'Admin Desa') }}"
                    required
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                           outline-none focus:border-[#2E7D32]"/>
            </div>

            {{-- Foto --}}
            <div>
                @include('admin.shared.foto_input', [
                    'currentFoto' => $berita->foto ?? null,
                    'label'       => 'Foto Berita',
                ])
            </div>

            {{-- Ringkasan --}}
            <div>
                <label class="block font-bold text-sm mb-2">Ringkasan *</label>
                <textarea
                    name="ringkasan"
                    rows="3"
                    required
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                           outline-none focus:border-[#2E7D32] resize-none
                           @error('ringkasan') border-red-500 @enderror">{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
                @error('ringkasan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label class="block font-bold text-sm mb-2">Konten Berita *</label>
                <textarea
                    name="konten"
                    rows="10"
                    required
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                           outline-none focus:border-[#2E7D32] resize-none
                           @error('konten') border-red-500 @enderror">{{ old('konten', $berita->konten ?? '') }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Published toggle --}}
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-300">
                <input type="hidden" name="published" value="0"/>
                <input
                    type="checkbox"
                    name="published"
                    id="published"
                    value="1"
                    {{ old('published', $berita->published ?? true) ? 'checked' : '' }}
                    class="w-4 h-4"/>
                <label for="published" class="font-bold text-sm cursor-pointer">
                    Publikasikan berita ini
                </label>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">
                    💾 {{ isset($berita) ? 'Perbarui Berita' : 'Simpan Berita' }}
                </button>
                <a href="{{ route('admin.berita.index') }}"
                   class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
