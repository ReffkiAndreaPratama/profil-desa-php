@extends('layouts.admin')

@section('title', isset($item) ? 'Edit UMKM' : 'Tambah UMKM')
@section('page_title', isset($item) ? 'Edit UMKM' : 'Tambah UMKM')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">🛍️ {{ isset($item) ? 'Edit' : 'Tambah' }} UMKM</h3>
        </div>

        <form action="{{ isset($item) ? route('admin.umkm.update', $item->id) : route('admin.umkm.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($item)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Produk / UMKM *</label>
                    <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kategori *</label>
                    <select name="kategori" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                        @foreach(['Makanan','Minuman','Kerajinan','Kesehatan','Pertanian','Lainnya'] as $k)
                            <option value="{{ $k }}" {{ old('kategori', $item->kategori ?? '') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Deskripsi *</label>
                <textarea name="deskripsi" rows="4" required
                          class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Foto --}}
            @include('admin.shared.foto_input', [
                'currentFoto' => $item->foto ?? null,
                'label'       => 'Foto Produk',
            ])

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Harga</label>
                    <input type="text" name="harga" value="{{ old('harga', $item->harga ?? '') }}" placeholder="Rp 45.000"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Pemilik</label>
                    <input type="text" name="pemilik" value="{{ old('pemilik', $item->pemilik ?? '') }}"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kontak WhatsApp</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $item->kontak ?? '') }}" placeholder="628..."
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $item->lokasi ?? '') }}" placeholder="Dusun I"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Status Stok</label>
                <select name="stok" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                    @foreach(['Tersedia','Terbatas','Habis'] as $s)
                        <option value="{{ $s }}" {{ old('stok', $item->stok ?? 'Tersedia') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-300">
                <input type="hidden" name="published" value="0"/>
                <input type="checkbox" name="published" id="published" value="1"
                       {{ old('published', $item->published ?? true) ? 'checked' : '' }} class="w-4 h-4"/>
                <label for="published" class="font-bold text-sm cursor-pointer">Tampilkan di halaman publik</label>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">💾 Simpan</button>
                <a href="{{ route('admin.umkm.index') }}" class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
