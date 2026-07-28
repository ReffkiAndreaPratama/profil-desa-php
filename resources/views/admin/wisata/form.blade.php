@extends('layouts.admin')

@section('title', isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata')
@section('page_title', isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">⛰️ {{ isset($wisata) ? 'Edit' : 'Tambah' }} Wisata</h3>
        </div>

        <form action="{{ isset($wisata) ? route('admin.wisata.update', $wisata->id) : route('admin.wisata.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($wisata)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Wisata *</label>
                    <input type="text" name="nama" value="{{ old('nama', $wisata->nama ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kategori *</label>
                    <select name="kategori" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                        @foreach(['Alam','Agrowisata','Budaya','Edukasi'] as $k)
                            <option value="{{ $k }}" {{ old('kategori', $wisata->kategori ?? '') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Deskripsi *</label>
                <textarea name="deskripsi" rows="4" required
                          class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none">{{ old('deskripsi', $wisata->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Foto --}}
            @include('admin.shared.foto_input', [
                'currentFoto' => $wisata->foto ?? null,
                'label'       => 'Foto Wisata',
            ])

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Harga</label>
                    <input type="text" name="harga" value="{{ old('harga', $wisata->harga ?? '') }}" placeholder="Rp 10.000/orang"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jam Operasional</label>
                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $wisata->jam_operasional ?? '') }}" placeholder="07.00 - 17.00 WIB"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Rating</label>
                    <input type="number" name="rating" step="0.1" min="0" max="5" value="{{ old('rating', $wisata->rating ?? '') }}" placeholder="4.7"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Pengunjung/Bulan</label>
                    <input type="text" name="pengunjung" value="{{ old('pengunjung', $wisata->pengunjung ?? '') }}" placeholder="500+/bulan"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Fasilitas (pisah koma)</label>
                <input type="text" name="fasilitas"
                       value="{{ old('fasilitas', isset($wisata) ? implode(', ', $wisata->fasilitas ?? []) : '') }}"
                       placeholder="Parkir, Toilet, Warung"
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Link Google Maps</label>
                <input type="text" name="maps" value="{{ old('maps', $wisata->maps ?? '') }}"
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-300">
                <input type="hidden" name="published" value="0"/>
                <input type="checkbox" name="published" id="published" value="1"
                       {{ old('published', $wisata->published ?? true) ? 'checked' : '' }} class="w-4 h-4"/>
                <label for="published" class="font-bold text-sm cursor-pointer">Tampilkan di halaman publik</label>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">💾 Simpan</button>
                <a href="{{ route('admin.wisata.index') }}" class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
