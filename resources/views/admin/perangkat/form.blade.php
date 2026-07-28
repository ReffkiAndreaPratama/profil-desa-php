@extends('layouts.admin')

@section('title', isset($perangkat) ? 'Edit Perangkat' : 'Tambah Perangkat')
@section('page_title', isset($perangkat) ? 'Edit Perangkat' : 'Tambah Perangkat')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">👤 {{ isset($perangkat) ? 'Edit' : 'Tambah' }} Perangkat Desa</h3>
        </div>

        <form action="{{ isset($perangkat) ? route('admin.perangkat.update', $perangkat->id) : route('admin.perangkat.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($perangkat)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Jabatan *</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $perangkat->jabatan ?? '') }}"
                           required placeholder="Kepala Desa"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $perangkat->nama ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">No. HP / WA</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $perangkat->kontak ?? '') }}"
                           placeholder="08xxx"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Urutan Tampil</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $perangkat->urutan ?? 0) }}" min="0"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            {{-- Foto --}}
            @include('admin.shared.foto_input', [
                'currentFoto' => $perangkat->foto ?? null,
                'label'       => 'Foto',
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">
                    💾 Simpan
                </button>
                <a href="{{ route('admin.perangkat.index') }}"
                   class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
