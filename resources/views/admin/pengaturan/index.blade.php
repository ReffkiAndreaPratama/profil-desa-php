@extends('layouts.admin')

@section('title', 'Pengaturan Desa')
@section('page_title', 'Pengaturan Desa')

@section('content')

@php
$visiDefault = 'MENINGKATKAN TATA KELOLA PEMERINTAHAN DESA YANG BAIK DAN BERSIH GUNA MEWUJUDKAN DESA TALANG MARAP YANG ADIL, MAKMUR, SEJAHTERA DAN BERDASARKAN MUSYAWARAH MUFAKAT.';
$misiDefault = "Mewujudkan pemerintah Desa yang tertib, aman, dan transparan\nMewujudkan pembangunan yang merata baik fisik dan pembangunan SDM\nMewujudkan perekonomian dan kesejahteraan masyarakat\nMewujudkan masyarakat yang berakhlak dan religious\nMewujudkan Masyarakat sehat\nMengaktifkan kegiatan kepemudaan\nMewujudkan kegiatan yang jujur, adil dan transparan";
$sejarahDefault = json_encode([
    ['tahun' => '1912', 'judul' => 'Zaman Depati Kaemajis', 'desc' => 'Talang Marap diambil dari keyakinan masyarakat terhadap Dewa Pelindung pada tahun 1912. Kepemimpinan dipegang oleh Depati Kaemajis (1912-1965).'],
    ['tahun' => '1965', 'judul' => 'Zaman Depati Buyung Alinap', 'desc' => 'Masa kepemimpinan dilanjutkan oleh Depati Buyung Alinap (1965-1972).'],
    ['tahun' => '1972', 'judul' => 'Sistem Kepala Desa Pertama', 'desc' => 'Ditiadakannya wilayah Pasirah oleh Pemerintah RI. Jabatan Depati diubah menjadi Kepala Desa, dijabat pertama oleh Idris Ali (1972-1988).'],
    ['tahun' => '1988', 'judul' => 'Masa Jabatan Irsanudin', 'desc' => 'Kepala Desa Irsanudin menjabat dari 1988 hingga 1999. Sempat diisi oleh Pjs. Yaswan dari Kecamatan Kaur Utara karena kekosongan.'],
    ['tahun' => '2000', 'judul' => 'Kepemimpinan Justan', 'desc' => 'Justan memimpin desa hasil pemilihan langsung masyarakat (2000-2006).'],
    ['tahun' => '2005', 'judul' => 'Pemekaran Desa', 'desc' => 'Pemekaran Desa Talang Marap dengan Desa Pagar Dewa, Kecamatan Kelam Tengah.'],
    ['tahun' => '2007', 'judul' => 'Kepemimpinan Disirmin', 'desc' => 'Disirmin menjabat dari 2007 hingga 2013.'],
    ['tahun' => '2009', 'judul' => 'Pemekaran Kecamatan', 'desc' => 'Kabupaten Kaur memisahkan diri dari Bengkulu Selatan, memicu pemekaran Kecamatan Kelam Tengah, sehingga secara definitif terbentuk Desa Talang Marap.'],
    ['tahun' => '2016', 'judul' => 'Kepemimpinan Janusi A. Hamid', 'desc' => 'Janusi A. Hamid terpilih secara langsung oleh masyarakat sebagai Kepala Desa periode 2016-2021.'],
    ['tahun' => '2022', 'judul' => 'Kepemimpinan Midarman', 'desc' => 'Midarman menjabat sebagai Kepala Desa terpilih secara langsung untuk masa jabatan 2022 sampai dengan 2028.'],
]);
$pekerjaanDefault = json_encode([
    ['label' => 'Petani', 'value' => 320],
    ['label' => 'Pelajar/Mahasiswa', 'value' => 120],
    ['label' => 'Ibu Rumah Tangga', 'value' => 110],
    ['label' => 'Swasta', 'value' => 60],
    ['label' => 'Pedagang', 'value' => 38],
]);
@endphp

<div class="max-w-4xl space-y-6">

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- ── Identitas Desa ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#212121] p-4">
                <h3 class="font-black text-white">🏡 Identitas Desa</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    @include('admin.shared.foto_input', [
                        'currentFoto' => $settings['logo'] ?? null,
                        'label'       => 'Logo Desa',
                        'required'    => false,
                    ])
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Nama Desa *</label>
                    <input
                        type="text"
                        name="nama_desa"
                        value="{{ $settings['nama_desa'] ?? 'Desa Talang Marap' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kecamatan *</label>
                    <input
                        type="text"
                        name="kecamatan"
                        value="{{ $settings['kecamatan'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kabupaten *</label>
                    <input
                        type="text"
                        name="kabupaten"
                        value="{{ $settings['kabupaten'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Provinsi *</label>
                    <input
                        type="text"
                        name="provinsi"
                        value="{{ $settings['provinsi'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-bold text-sm mb-2">Tagline</label>
                    <input
                        type="text"
                        name="tagline"
                        value="{{ $settings['tagline'] ?? '' }}"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Kepala Desa *</label>
                    <input
                        type="text"
                        name="kepala_desa"
                        value="{{ $settings['kepala_desa'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jam Operasional *</label>
                    <input
                        type="text"
                        name="jam_operasional"
                        value="{{ $settings['jam_operasional'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-bold text-sm mb-2">Alamat *</label>
                    <input
                        type="text"
                        name="alamat"
                        value="{{ $settings['alamat'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
        </div>

        {{-- ── Data Kependudukan ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#2E7D32] p-4">
                <h3 class="font-black text-white">👥 Data Kependudukan & Wilayah</h3>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah Penduduk</label>
                    <input
                        type="text"
                        name="jumlah_penduduk"
                        value="{{ $settings['jumlah_penduduk'] ?? '1847' }}"
                        placeholder="contoh: 1847"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32] text-center font-bold text-lg"/>
                    <p class="text-xs text-gray-500 mt-1 text-center">jiwa</p>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah KK</label>
                    <input
                        type="text"
                        name="jumlah_kk"
                        value="{{ $settings['jumlah_kk'] ?? '512' }}"
                        placeholder="contoh: 512"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32] text-center font-bold text-lg"/>
                    <p class="text-xs text-gray-500 mt-1 text-center">KK</p>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Luas Wilayah</label>
                    <input
                        type="text"
                        name="luas_wilayah"
                        value="{{ $settings['luas_wilayah'] ?? '24.5 km²' }}"
                        placeholder="contoh: 24.5 km²"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32] text-center font-bold text-lg"/>
                    <p class="text-xs text-gray-500 mt-1 text-center">km²</p>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah Dusun</label>
                    <input
                        type="text"
                        name="jumlah_dusun"
                        value="{{ $settings['jumlah_dusun'] ?? '4' }}"
                        placeholder="contoh: 4"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32] text-center font-bold text-lg"/>
                    <p class="text-xs text-gray-500 mt-1 text-center">dusun</p>
                </div>
            </div>
        </div>

        {{-- ── Lokasi & Peta ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#1565C0] p-4">
                <h3 class="font-black text-white">🗺️ Lokasi & Peta Desa</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Link Google Maps Desa</label>
                    <input
                        type="url"
                        name="maps_desa"
                        value="{{ $settings['maps_desa'] ?? '' }}"
                        placeholder="https://maps.google.com/maps?q=..."
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#1565C0]"/>
                    <p class="text-xs text-gray-500 mt-1">
                        URL Google Maps untuk tombol "Buka di Google Maps" di halaman peta publik.
                    </p>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Koordinat Desa (Lat, Lng)</label>
                    <input
                        type="text"
                        name="koordinat_desa"
                        value="{{ $settings['koordinat_desa'] ?? '-4.35, 103.12' }}"
                        placeholder="-4.35, 103.12"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#1565C0]"/>
                    <p class="text-xs text-gray-500 mt-1">
                        Format: latitude, longitude. Digunakan untuk pin di peta interaktif Leaflet.
                        Contoh: <code>-4.35, 103.12</code>
                    </p>
                </div>
                @if(!empty($settings['maps_desa']))
                    <a href="{{ $settings['maps_desa'] }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-[#1565C0] text-white
                              rounded-xl font-bold text-sm border-2 border-[#212121]
                              hover:bg-[#1976D2] transition-all">
                        🗺️ Lihat di Google Maps
                    </a>
                @endif
            </div>
        </div>

        {{-- ── Kontak ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#212121] p-4">
                <h3 class="font-black text-white">📞 Kontak Desa</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">No. WhatsApp *</label>
                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ $settings['whatsapp'] ?? '' }}"
                        required
                        placeholder="628..."
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Email *</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ $settings['email'] ?? '' }}"
                        required
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
        </div>

        {{-- ── Visi, Misi & Sejarah ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden"
             x-data="{
                timeline: {!! old('sejarah', $settings['sejarah'] ?? $sejarahDefault) !!},
                addItem() {
                    this.timeline.push({ tahun: '', judul: '', desc: '' });
                },
                removeItem(index) {
                    this.timeline.splice(index, 1);
                }
             }">
            <div class="bg-[#2E7D32] p-4 border-b-4 border-[#212121]">
                <h3 class="font-black text-white">👁️ Visi, Misi & Sejarah Desa</h3>
            </div>
            <div class="p-6 space-y-6">
                {{-- Visi --}}
                <div>
                    <label class="block font-bold text-sm mb-2">Visi Desa</label>
                    <textarea
                        name="visi"
                        rows="3"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] font-semibold"
                        placeholder="Masukkan visi desa...">{{ old('visi', $settings['visi'] ?? $visiDefault) }}</textarea>
                </div>

                {{-- Misi --}}
                <div>
                    <label class="block font-bold text-sm mb-2">Misi Desa (Satu misi per baris)</label>
                    <textarea
                        name="misi"
                        rows="6"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"
                        placeholder="Tuliskan misi desa, pisahkan setiap misi dengan menekan Enter (satu misi per baris)...">{{ old('misi', $settings['misi'] ?? $misiDefault) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Pisahkan setiap poin misi dengan baris baru (Enter).</p>
                </div>

                <hr class="border-2 border-[#212121] my-6">

                {{-- Sejarah (Timeline) --}}
                <div>
                    <label class="block font-bold text-sm mb-4">Sejarah / Timeline Desa</label>
                    
                    <input type="hidden" name="sejarah" :value="JSON.stringify(timeline)">

                    <div class="space-y-4">
                        <template x-for="(item, index) in timeline" :key="index">
                            <div class="p-4 bg-gray-50 border-4 border-[#212121] rounded-xl relative shadow-[3px_3px_0_#212121]">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs font-black mb-1">Tahun</label>
                                        <input
                                            type="text"
                                            x-model="item.tahun"
                                            placeholder="Contoh: 1945"
                                            class="w-full px-3 py-2 border-2 border-[#212121] rounded-lg text-sm font-bold outline-none focus:border-[#2E7D32]"/>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-xs font-black mb-1">Judul Peristiwa</label>
                                        <input
                                            type="text"
                                            x-model="item.judul"
                                            placeholder="Contoh: Berdirinya Desa"
                                            class="w-full px-3 py-2 border-2 border-[#212121] rounded-lg text-sm font-bold outline-none focus:border-[#2E7D32]"/>
                                    </div>
                                    <div class="md:col-span-4">
                                        <label class="block text-xs font-black mb-1">Deskripsi Peristiwa</label>
                                        <textarea
                                            x-model="item.desc"
                                            rows="2"
                                            placeholder="Deskripsi singkat mengenai peristiwa bersejarah ini..."
                                            class="w-full px-3 py-2 border-2 border-[#212121] rounded-lg text-sm outline-none focus:border-[#2E7D32]"></textarea>
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    @click="removeItem(index)"
                                    class="absolute -top-3 -right-3 w-8 h-8 bg-[#D32F2F] text-white rounded-full flex items-center justify-center border-2 border-[#212121] shadow-[2px_2px_0_#212121] hover:translate-y-[1px] hover:shadow-[1px_1px_0_#212121] font-black text-sm">
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>

                    <button
                        type="button"
                        @click="addItem()"
                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl font-bold text-sm border-2 border-[#212121] shadow-[2px_2px_0_#212121] hover:bg-blue-700 hover:translate-y-[1px]">
                        ➕ Tambah Peristiwa Sejarah
                    </button>
                </div>
            </div>
        </div>

        {{-- ── Media Sosial ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#212121] p-4">
                <h3 class="font-black text-white">📱 Media Sosial</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">Instagram</label>
                    <div class="flex items-center border-[3px] border-[#212121] rounded-xl overflow-hidden">
                        <span class="px-3 py-3 bg-gray-100 text-gray-500 text-sm font-bold
                                     border-r-[3px] border-[#212121]">@</span>
                        <input
                            type="text"
                            name="instagram"
                            value="{{ $settings['instagram'] ?? '' }}"
                            placeholder="desatalangmarap"
                            class="flex-1 px-4 py-3 outline-none focus:bg-[#E8F5E9]"/>
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Facebook</label>
                    <input
                        type="text"
                        name="facebook"
                        value="{{ $settings['facebook'] ?? '' }}"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">TikTok</label>
                    <div class="flex items-center border-[3px] border-[#212121] rounded-xl overflow-hidden">
                        <span class="px-3 py-3 bg-gray-100 text-gray-500 text-sm font-bold
                                     border-r-[3px] border-[#212121]">@</span>
                        <input
                            type="text"
                            name="tiktok"
                            value="{{ $settings['tiktok'] ?? '' }}"
                            placeholder="desatalangmarap"
                            class="flex-1 px-4 py-3 outline-none focus:bg-[#E8F5E9]"/>
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">YouTube</label>
                    <input
                        type="text"
                        name="youtube"
                        value="{{ $settings['youtube'] ?? '' }}"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                               outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>
        </div>

        {{-- ── Mata Pencaharian / Pekerjaan ── --}}
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden"
             x-data="{
                pekerjaanList: {!! old('pekerjaan', $settings['pekerjaan'] ?? $pekerjaanDefault) !!},
                addItem() {
                    this.pekerjaanList.push({ label: '', value: 0 });
                },
                removeItem(index) {
                    this.pekerjaanList.splice(index, 1);
                }
             }">
            <div class="bg-[#1565C0] p-4 border-b-4 border-[#212121]">
                <h3 class="font-black text-white">📊 Mata Pencaharian / Pekerjaan Penduduk</h3>
            </div>
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-500">
                    Masukkan daftar mata pencaharian penduduk beserta perkiraan jumlah jiwanya. Sistem akan menghitung persentase secara otomatis di halaman web.
                </p>

                <input type="hidden" name="pekerjaan" :value="JSON.stringify(pekerjaanList)">

                <div class="space-y-3">
                    <template x-for="(item, index) in pekerjaanList" :key="index">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 border-2 border-[#212121] rounded-xl relative shadow-[2px_2px_0_#212121]">
                            <div class="flex-1">
                                <label class="block text-xs font-black mb-1">Nama Pekerjaan</label>
                                <input
                                    type="text"
                                    x-model="item.label"
                                    placeholder="Contoh: Petani, Buruh"
                                    class="w-full px-3 py-2 border-2 border-[#212121] rounded-lg text-sm font-bold outline-none focus:border-[#1565C0]"/>
                            </div>
                            <div class="w-32">
                                <label class="block text-xs font-black mb-1">Jumlah Jiwa</label>
                                <input
                                    type="number"
                                    x-model.number="item.value"
                                    placeholder="0"
                                    class="w-full px-3 py-2 border-2 border-[#212121] rounded-lg text-sm font-bold text-center outline-none focus:border-[#1565C0]"/>
                            </div>
                            <button
                                type="button"
                                @click="removeItem(index)"
                                class="mt-5 w-9 h-9 bg-[#D32F2F] text-white rounded-lg flex items-center justify-center border-2 border-[#212121] shadow-[2px_2px_0_#212121] hover:translate-y-[1px] hover:shadow-[1px_1px_0_#212121] font-black text-sm shrink-0">
                                ✕
                            </button>
                        </div>
                    </template>
                </div>

                <button
                    type="button"
                    @click="addItem()"
                    class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl font-bold text-sm border-2 border-[#212121] shadow-[2px_2px_0_#212121] hover:bg-blue-700 hover:translate-y-[1px]">
                    ➕ Tambah Pekerjaan
                </button>
            </div>
        </div>

        {{-- ── Save button ── --}}
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black text-base
                       hover:bg-[#1B5E20]">
                💾 Simpan Semua Pengaturan
            </button>
            <a href="{{ route('home') }}"
               target="_blank"
               class="text-sm font-bold text-[#2E7D32] underline">
                🌐 Lihat Hasil di Website →
            </a>
        </div>

    </form>
</div>

@endsection
