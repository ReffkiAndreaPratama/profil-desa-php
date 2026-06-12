@extends('layouts.admin')
@section('title', 'Pengaturan Desa')
@section('page_title', 'Pengaturan Desa')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
        <div class="bg-[#212121] p-4"><h3 class="font-black text-white">⚙️ Pengaturan Informasi Desa</h3></div>
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @php
            $s = $settings;
            @endphp
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Desa *</label>
                    <input type="text" name="nama_desa" value="{{ $s['nama_desa'] ?? 'Desa Talang Marap' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kecamatan *</label>
                    <input type="text" name="kecamatan" value="{{ $s['kecamatan'] ?? 'Kecamatan Kelam Tengah' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kabupaten *</label>
                    <input type="text" name="kabupaten" value="{{ $s['kabupaten'] ?? 'Kabupaten Kaur' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Provinsi *</label>
                    <input type="text" name="provinsi" value="{{ $s['provinsi'] ?? 'Provinsi Bengkulu' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
            <div>
                <label class="block font-bold text-sm mb-2">Tagline</label>
                <input type="text" name="tagline" value="{{ $s['tagline'] ?? '' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Kepala Desa *</label>
                    <input type="text" name="kepala_desa" value="{{ $s['kepala_desa'] ?? '' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">No. WhatsApp *</label>
                    <input type="text" name="whatsapp" value="{{ $s['whatsapp'] ?? '' }}" required placeholder="628..." class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
            <div>
                <label class="block font-bold text-sm mb-2">Email *</label>
                <input type="email" name="email" value="{{ $s['email'] ?? '' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>
            <div>
                <label class="block font-bold text-sm mb-2">Alamat *</label>
                <input type="text" name="alamat" value="{{ $s['alamat'] ?? '' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>
            <div>
                <label class="block font-bold text-sm mb-2">Jam Operasional *</label>
                <input type="text" name="jam_operasional" value="{{ $s['jam_operasional'] ?? '' }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Instagram</label>
                    <input type="text" name="instagram" value="{{ $s['instagram'] ?? '' }}" placeholder="desatalangmarap" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Facebook</label>
                    <input type="text" name="facebook" value="{{ $s['facebook'] ?? '' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
            <hr class="border-2"/>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah Penduduk</label>
                    <input type="text" name="jumlah_penduduk" value="{{ $s['jumlah_penduduk'] ?? '1847' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah KK</label>
                    <input type="text" name="jumlah_kk" value="{{ $s['jumlah_kk'] ?? '512' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Luas Wilayah</label>
                    <input type="text" name="luas_wilayah" value="{{ $s['luas_wilayah'] ?? '24.5 km²' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah Dusun</label>
                    <input type="text" name="jumlah_dusun" value="{{ $s['jumlah_dusun'] ?? '4' }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
            <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">💾 Simpan Pengaturan</button>
        </form>
    </div>
</div>
@endsection
