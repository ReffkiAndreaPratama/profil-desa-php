@extends('layouts.admin')

@section('title', isset($anggota) ? 'Edit Anggota KKN' : 'Tambah Anggota KKN')
@section('page_title', isset($anggota) ? 'Edit Anggota KKN' : 'Tambah Anggota KKN')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">🎓 {{ isset($anggota) ? 'Edit' : 'Tambah' }} Anggota KKN</h3>
        </div>

        <form action="{{ isset($anggota) ? route('admin.kkn-anggota.update', $anggota->id) : route('admin.kkn-anggota.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @if(isset($anggota)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $anggota->nama ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim', $anggota->nim ?? '') }}"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Program Studi *</label>
                    <input type="text" name="prodi" value="{{ old('prodi', $anggota->prodi ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Fakultas *</label>
                    <input type="text" name="fakultas" value="{{ old('fakultas', $anggota->fakultas ?? '') }}" required
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div class="col-span-2">
                    <label class="block font-bold text-sm mb-2">Username Instagram (Tanpa @)</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $anggota->instagram ?? '') }}" placeholder="contoh: desatalangmarap"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Posisi / Divisi *</label>
                <select name="posisi" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                    @php
                    $posisiList = ['Ketua','Wakil Ketua','Sekretaris','Bendahara',
                                   'Bidang Pendidikan','Bidang Kesehatan','Bidang Lingkungan','Bidang Ekonomi',
                                   'Acara','PDK','Humas','Perlengkapan','Konsumsi','Anggota'];
                    @endphp
                    @foreach($posisiList as $p)
                        <option value="{{ $p }}" {{ old('posisi', $anggota->posisi ?? '') === $p ? 'selected' : '' }}>
                            {{ $p }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Foto --}}
            @include('admin.shared.foto_input', [
                'currentFoto' => $anggota->foto ?? null,
                'label'       => 'Foto',
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">
                    💾 Simpan
                </button>
                <a href="{{ route('admin.kkn-anggota.index') }}"
                   class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
