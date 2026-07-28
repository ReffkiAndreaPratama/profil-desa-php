@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Foto' : 'Tambah Foto')
@section('page_title', isset($galeri) ? 'Edit Foto' : 'Tambah Foto')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">🖼️ {{ isset($galeri) ? 'Edit' : 'Tambah' }} Foto Galeri</h3>
        </div>

        <form action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($galeri)) @method('PUT') @endif

            <div>
                <label class="block font-bold text-sm mb-2">Judul Foto *</label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Kategori *</label>
                <select name="kategori" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                    @foreach(['Kegiatan','Pembangunan','Wisata','Budaya','Lingkungan','KKN','Lainnya'] as $k)
                        <option value="{{ $k }}" {{ old('kategori', $galeri->kategori ?? '') === $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($galeri) ? $galeri->tanggal->format('Y-m-d') : date('Y-m-d')) }}" required
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>

            {{-- Foto input dengan opsi URL / Upload --}}
            @include('admin.shared.foto_input', [
                'currentFoto' => $galeri->foto ?? null,
                'label'       => 'Foto *',
                'required'    => !isset($galeri),
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">
                    💾 Simpan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
