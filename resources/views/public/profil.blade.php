@extends('layouts.public')

@section('title', 'Profil Desa - Smart Village Talang Marap')

@section('content')

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Page header with breadcrumb ── --}}
    <div class="gradient-green border-b-4 border-[#212121] py-12">
        <div class="container-custom text-white">
            <p class="text-white/60 text-sm mb-3">Beranda › Profil Desa</p>
            <h1 class="text-4xl font-black mb-2">Profil Desa Talang Marap</h1>
            <p class="text-white/80">
                {{ $desa['kecamatan'] }} · {{ $desa['kabupaten'] }} · {{ $desa['provinsi'] }}
            </p>
        </div>
    </div>

    <div class="container-custom py-8">

        {{-- ── Info cards ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="brutal-card p-4 flex items-center gap-3">
                <span class="text-2xl">📍</span>
                <div>
                    <p class="text-xs text-gray-400">Lokasi</p>
                    <p class="font-bold text-sm">{{ $desa['kecamatan'] }}</p>
                </div>
            </div>
            <div class="brutal-card p-4 flex items-center gap-3">
                <span class="text-2xl">📞</span>
                <div>
                    <p class="text-xs text-gray-400">WhatsApp</p>
                    <p class="font-bold text-sm">+62 {{ substr($desa['whatsapp'] ?? '', 2) }}</p>
                </div>
            </div>
            <div class="brutal-card p-4 flex items-center gap-3">
                <span class="text-2xl">✉️</span>
                <div>
                    <p class="text-xs text-gray-400">Email</p>
                    <p class="font-bold text-sm truncate">{{ $desa['email'] }}</p>
                </div>
            </div>
            <div class="brutal-card p-4 flex items-center gap-3">
                <span class="text-2xl">🗺️</span>
                <div>
                    <p class="text-xs text-gray-400">Luas Wilayah</p>
                    <p class="font-bold text-sm">{{ $desa['luas_wilayah'] ?? '24.5 km²' }}</p>
                </div>
            </div>
        </div>

        {{-- ── Tab navigation ── --}}
        <div class="flex gap-2 mb-8 overflow-x-auto pb-2" id="tabNav">
            @foreach(['sejarah' => 'Sejarah', 'visi' => 'Visi & Misi', 'perangkat' => 'Perangkat Desa', 'demografi' => 'Kondisi & Demografi'] as $key => $label)
                <button
                    data-tab="{{ $key }}"
                    onclick="switchTab('{{ $key }}')"
                    id="tab-btn-{{ $key }}"
                    class="brutal-btn px-5 py-2.5 rounded-xl font-bold text-sm whitespace-nowrap flex-shrink-0
                           {{ $key === 'sejarah' ? 'bg-[#2E7D32] text-white' : 'bg-white text-[#212121]' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- ── Tab: Sejarah ── --}}
        <div id="tab-sejarah" class="tab-panel">

            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32]
                         text-xs font-black px-4 py-1 rounded-full mb-3">
                SEJARAH
            </span>
            <h2 class="text-3xl font-black mb-8">
                Perjalanan Desa <span class="text-gradient">Talang Marap</span>
            </h2>

            @if(!empty($desa['sejarah_narasi']))
                <div class="brutal-card p-6 mb-8 bg-[#fdfdfd] border-4 border-[#212121] shadow-[4px_4px_0_#212121]">
                    <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                        <span>📖</span> Cerita Singkat Sejarah Desa
                    </h3>
                    <div class="text-[#212121] leading-relaxed text-sm space-y-4 font-medium">
                        @foreach(explode("\n\n", $desa['sejarah_narasi']) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @php
            $timeline = json_decode($desa['sejarah'] ?? '[]', true);
            @endphp

            <div class="relative">
                <div class="absolute left-8 top-0 bottom-0 w-1 bg-[#2E7D32] rounded-full"></div>
                <div class="space-y-6">
                    @foreach($timeline as $t)
                        <div class="relative flex gap-6 items-start">
                            <div class="w-16 h-16 rounded-2xl bg-[#2E7D32] border-4 border-[#212121]
                                        shadow-[4px_4px_0_#212121] flex flex-col items-center
                                        justify-center shrink-0 z-10">
                                <span class="text-white font-black text-xs text-center">{{ $t['tahun'] }}</span>
                            </div>
                            <div class="brutal-card p-5 flex-1 mt-1">
                                <h3 class="font-black text-base mb-1">{{ $t['judul'] }}</h3>
                                <p class="text-gray-500 text-sm">{{ $t['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ── Daftar Nama Kepala Desa ── --}}
            <div class="brutal-card p-6 mt-12 bg-white border-4 border-[#212121] shadow-[4px_4px_0_#212121]">
                <h3 class="font-black text-xl mb-6 flex items-center gap-2">
                    <span>👑</span> Silsilah Kepemimpinan Desa
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border-4 border-[#212121] text-left text-sm font-bold">
                        <thead>
                            <tr class="bg-[#2E7D32] text-white border-b-4 border-[#212121]">
                                <th class="p-3 border-r-4 border-[#212121] w-12 text-center">No</th>
                                <th class="p-3 border-r-4 border-[#212121]">Nama Kepala Desa</th>
                                <th class="p-3 border-r-4 border-[#212121] text-center w-40">Masa Jabatan</th>
                                <th class="p-3 text-center w-36">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-4 divide-[#212121]">
                            @php
                            $kepalaDesaList = [
                                ['no' => 1, 'nama' => 'Kaemadjis', 'masa' => '1912 s/d 1965', 'ket' => 'Depati'],
                                ['no' => 2, 'nama' => 'Buyung Alinap', 'masa' => '1965 s/d 1972', 'ket' => 'Depati'],
                                ['no' => 3, 'nama' => 'Idris Ali', 'masa' => '1972 s/d 1988', 'ket' => 'Kepala Desa'],
                                ['no' => 4, 'nama' => 'Irsanudin', 'masa' => '1988 s/d 1999', 'ket' => 'Kepala Desa'],
                                ['no' => 5, 'nama' => 'Justan', 'masa' => '2000 s/d 2006', 'ket' => 'Kepala Desa'],
                                ['no' => 6, 'nama' => 'Disirmin', 'masa' => '2007 s/d 2013', 'ket' => 'Kepala Desa'],
                                ['no' => 7, 'nama' => 'Janusi A. Hamid', 'masa' => '2016 s/d 2021', 'ket' => 'Kepala Desa'],
                                ['no' => 8, 'nama' => 'Midarman', 'masa' => '2022 s/d Sekarang', 'ket' => 'Kepala Desa'],
                            ];
                            @endphp
                            @foreach($kepalaDesaList as $k)
                                <tr class="hover:bg-gray-50 border-b-4 border-[#212121] last:border-b-0">
                                    <td class="p-3 border-r-4 border-[#212121] text-center">{{ $k['no'] }}</td>
                                    <td class="p-3 border-r-4 border-[#212121]">{{ $k['nama'] }}</td>
                                    <td class="p-3 border-r-4 border-[#212121] text-center">{{ $k['masa'] }}</td>
                                    <td class="p-3 text-center">
                                        <span class="inline-block px-2.5 py-1 text-xs font-black rounded-lg border-2 border-[#212121] 
                                            {{ $k['ket'] === 'Depati' ? 'bg-amber-200 text-amber-900' : 'bg-[#E8F5E9] text-[#2E7D32]' }}">
                                            {{ $k['ket'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ── Tab: Visi & Misi ── --}}
        <div id="tab-visi" class="tab-panel hidden space-y-6">

            @php
            $misi = array_filter(array_map('trim', explode("\n", $desa['misi'] ?? '')));
            @endphp

            @if(!empty($desa['visi_deskripsi']))
                <div class="brutal-card p-6 bg-slate-50 border-4 border-[#212121] shadow-[4px_4px_0_#212121] text-[#212121]">
                    <div class="text-sm font-medium leading-relaxed space-y-3">
                        @foreach(explode("\n\n", $desa['visi_deskripsi']) as $p)
                            <p>{{ $p }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="brutal-card bg-gradient-to-br from-[#2E7D32] to-[#43A047] p-8 text-white">
                <h3 class="font-black text-xl mb-4">👁 Visi Desa</h3>
                <p class="text-white/90 text-lg font-semibold italic">
                    "{{ $desa['visi'] ?? '' }}"
                </p>
            </div>

            @if(!empty($desa['misi_deskripsi']))
                <div class="brutal-card p-6 bg-slate-50 border-4 border-[#212121] shadow-[4px_4px_0_#212121] text-[#212121]">
                    <div class="text-sm font-medium leading-relaxed">
                        <p>{{ $desa['misi_deskripsi'] }}</p>
                    </div>
                </div>
            @endif

            <div class="brutal-card p-8">
                <h3 class="font-black text-xl mb-6">🎯 Misi Desa</h3>
                <div class="space-y-4">
                    @foreach($misi as $i => $m)
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-[#2E7D32] text-white flex items-center
                                        justify-center shrink-0 font-black text-sm border-2 border-[#212121]">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-gray-600 font-semibold pt-1">{{ $m }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── Tab: Perangkat Desa ── --}}
        <div id="tab-perangkat" class="tab-panel hidden">

            <h2 class="text-3xl font-black mb-8">
                Struktur <span class="text-gradient">Pemerintahan</span>
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                @foreach($perangkat as $p)
                    <div class="brutal-card p-5 text-center cursor-pointer hover:scale-[1.02] transition-transform duration-200"
                         onclick="openPerangkatModal(this)"
                         data-nama="{{ $p->nama }}"
                         data-jabatan="{{ $p->jabatan }}"
                         data-kontak="{{ $p->kontak }}"
                         data-foto="{{ \App\Helpers\FotoHelper::url($p->foto, 'https://ui-avatars.com/api/?name='.urlencode($p->nama).'&background=2E7D32&color=fff&size=200') }}">
                        <img src="{{ \App\Helpers\FotoHelper::url($p->foto, 'https://ui-avatars.com/api/?name='.urlencode($p->nama).'&background=2E7D32&color=fff&size=200') }}"
                             alt="{{ $p->nama }}"
                             class="w-20 h-20 rounded-full mx-auto mb-3 border-4 border-[#2E7D32] shadow-[3px_3px_0_#212121] object-cover"/>
                        <p class="font-black text-sm text-[#212121] dark:text-gray-200">{{ $p->nama }}</p>
                        <p class="text-[#2E7D32] text-xs font-bold mt-1">{{ $p->jabatan }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ── Tab: Demografi ── --}}
        <div id="tab-demografi" class="tab-panel hidden">

            <h2 class="text-3xl font-black mb-8">
                Data <span class="text-gradient">Kependudukan</span>
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="brutal-card p-5 text-center">
                    <p class="text-2xl font-black text-[#2E7D32]">
                        {{ $desa['jumlah_penduduk'] ?? ($statistik->penduduk ?? '—') }}
                    </p>
                    <p class="text-gray-500 text-sm font-bold">Total Penduduk</p>
                </div>
                <div class="brutal-card p-5 text-center">
                    <p class="text-2xl font-black text-blue-700">
                        {{ $statistik->laki_laki ?? '—' }}
                    </p>
                    <p class="text-gray-500 text-sm font-bold">Laki-laki</p>
                </div>
                <div class="brutal-card p-5 text-center">
                    <p class="text-2xl font-black text-pink-700">
                        {{ $statistik->perempuan ?? '—' }}
                    </p>
                    <p class="text-gray-500 text-sm font-bold">Perempuan</p>
                </div>
                <div class="brutal-card p-5 text-center">
                    <p class="text-2xl font-black text-orange-700">
                        {{ $desa['jumlah_kk'] ?? ($statistik->kk ?? '—') }}
                    </p>
                    <p class="text-gray-500 text-sm font-bold">Kartu Keluarga (KK)</p>
                </div>
            </div>

            {{-- Tambahan info wilayah --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                <div class="brutal-card p-4 flex items-center gap-3">
                    <span class="text-2xl">🗺️</span>
                    <div>
                        <p class="text-xs text-gray-400 font-bold">Luas Wilayah</p>
                        <p class="font-black text-sm">{{ $desa['luas_wilayah'] ?? '—' }}</p>
                    </div>
                </div>
                <div class="brutal-card p-4 flex items-center gap-3">
                    <span class="text-2xl">🏘️</span>
                    <div>
                        <p class="text-xs text-gray-400 font-bold">Jumlah Dusun</p>
                        <p class="font-black text-sm">{{ $desa['jumlah_dusun'] ?? '—' }} Dusun</p>
                    </div>
                </div>
                <div class="brutal-card p-4 flex items-center gap-3">
                    <span class="text-2xl">🛍️</span>
                    <div>
                        <p class="text-xs text-gray-400 font-bold">UMKM Aktif</p>
                        <p class="font-black text-sm">{{ $statistik->umkm ?? '—' }} Usaha</p>
                    </div>
                </div>
            </div>

            {{-- ── Seksi Geografis & Batas Wilayah ── --}}
            <h2 class="text-3xl font-black mt-12 mb-8">
                Kondisi <span class="text-gradient">Geografis & Wilayah</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Batas Wilayah Card --}}
                <div class="brutal-card p-6 md:col-span-2">
                    <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                        <span>🗺️</span> Batas Wilayah Administratif
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-3 bg-red-50 border-2 border-[#212121] rounded-xl flex items-center gap-3 shadow-[2px_2px_0_#212121]">
                            <span class="text-2xl">⬆️</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-black">Utara</p>
                                <p class="font-extrabold text-sm text-[#212121]">{{ $desa['geografi_batas_utara'] ?? 'Desa Talang Tais' }}</p>
                            </div>
                        </div>
                        <div class="p-3 bg-blue-50 border-2 border-[#212121] rounded-xl flex items-center gap-3 shadow-[2px_2px_0_#212121]">
                            <span class="text-2xl">⬇️</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-black">Selatan</p>
                                <p class="font-extrabold text-sm text-[#212121]">{{ $desa['geografi_batas_selatan'] ?? 'Desa Pagar Dewa' }}</p>
                            </div>
                        </div>
                        <div class="p-3 bg-yellow-50 border-2 border-[#212121] rounded-xl flex items-center gap-3 shadow-[2px_2px_0_#212121]">
                            <span class="text-2xl">⬅️</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-black">Barat</p>
                                <p class="font-extrabold text-sm text-[#212121]">{{ $desa['geografi_batas_barat'] ?? 'Desa Curup Air Putih' }}</p>
                            </div>
                        </div>
                        <div class="p-3 bg-emerald-50 border-2 border-[#212121] rounded-xl flex items-center gap-3 shadow-[2px_2px_0_#212121]">
                            <span class="text-2xl">➡️</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-black">Timur</p>
                                <p class="font-extrabold text-sm text-[#212121]">{{ $desa['geografi_batas_timur'] ?? 'Seranjangan Besar' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keluarga Miskin Card --}}
                <div class="brutal-card p-6 bg-red-100 flex flex-col justify-between border-4 border-[#212121] shadow-[4px_4px_0_#212121]">
                    <div>
                        <h3 class="font-black text-lg text-red-950 mb-2 flex items-center gap-2">
                            <span>📉</span> Keluarga Miskin (Gakin)
                        </h3>
                        <p class="text-xs text-red-800 font-semibold mb-4">Persentase keluarga prasejahtera di Desa Talang Marap</p>
                    </div>
                    @php
                    $gakinKk = (int)($desa['geografi_keluarga_miskin'] ?? 86);
                    $totalKk = (int)($desa['jumlah_kk'] ?? 211);
                    $gakinPct = $totalKk > 0 ? round(($gakinKk / $totalKk) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex items-baseline gap-2 mb-2">
                            <span class="text-4xl font-black text-red-950">{{ $gakinKk }}</span>
                            <span class="text-lg font-bold text-red-900">KK / {{ $gakinPct }}%</span>
                        </div>
                        <div class="h-4 bg-red-200 border-2 border-[#212121] rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 rounded-full" style="width: {{ $gakinPct }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Pembagian Lahan & Kondisi Fisik ── --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Pembagian Lahan Card --}}
                <div class="brutal-card p-6 md:col-span-2">
                    <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                        <span>🚜</span> Pembagian Luas Wilayah ({{ $desa['luas_wilayah'] ?? '4610 Ha' }})
                    </h3>
                    @php
                    $luasTotal = (float)($desa['geografi_luas_total'] ?? 6000);
                    $lahan = [
                        ['label' => 'Perkebunan', 'luas' => (float)($desa['geografi_luas_perkebunan'] ?? 1300), 'color' => 'bg-emerald-600'],
                        ['label' => 'Ladang', 'luas' => (float)($desa['geografi_luas_ladang'] ?? 1250), 'color' => 'bg-amber-600'],
                        ['label' => 'Pemukiman', 'luas' => (float)($desa['geografi_luas_pemukiman'] ?? 1000), 'color' => 'bg-indigo-600'],
                        ['label' => 'Lain-lain', 'luas' => (float)($desa['geografi_luas_lainnya'] ?? 1000), 'color' => 'bg-slate-500'],
                        ['label' => 'Persawahan', 'luas' => (float)($desa['geografi_luas_persawahan'] ?? 60), 'color' => 'bg-teal-500'],
                    ];
                    @endphp
                    <div class="space-y-3">
                        @foreach($lahan as $l)
                            @php
                            $lPct = $luasTotal > 0 ? round(($l['luas'] / $luasTotal) * 100, 1) : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1 text-[#212121] dark:text-gray-300">
                                    <span>{{ $l['label'] }}</span>
                                    <span>{{ $l['luas'] }} Ha ({{ $lPct }}%)</span>
                                </div>
                                <div class="h-3.5 bg-gray-100 rounded-full border-2 border-[#212121] overflow-hidden">
                                    <div class="h-full {{ $l['color'] }} rounded-full" style="width: {{ $luasTotal > 0 ? ($l['luas'] / $luasTotal) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Topografi & Iklim Card --}}
                <div class="brutal-card p-6 bg-emerald-50 border-4 border-[#212121] shadow-[4px_4px_0_#212121] flex flex-col justify-between">
                    <div>
                        <h3 class="font-black text-lg text-emerald-950 mb-3 flex items-center gap-2">
                            <span>⛅</span> Topografi & Iklim
                        </h3>
                        <p class="text-xs text-gray-700 leading-relaxed font-semibold mb-4">
                            {{ $desa['geografi_topografi'] ?? 'Secara umum keadaan Topografi Desa Talang Marap adalah merupakan daerah dataran rendah bergelombang.' }}
                        </p>
                    </div>
                    <div class="pt-3 border-t-2 border-dashed border-emerald-900/20 text-xs text-gray-700 font-semibold leading-relaxed">
                        {{ $desa['geografi_iklim'] ?? 'Memiliki iklim kemarau dan penghujan yang mempengaruhi secara langsung pola tanam pertanian.' }}
                    </div>
                </div>
            </div>

            @php
            $pekerjaanList = json_decode($desa['pekerjaan'] ?? '[]', true);
            $sumPekerjaan = array_sum(array_column($pekerjaanList, 'value'));
            $pekerjaan = [];
            foreach ($pekerjaanList as $item) {
                $val = (int) $item['value'];
                $pct = $sumPekerjaan > 0 ? round(($val / $sumPekerjaan) * 100) : 0;
                $pekerjaan[] = [
                    'label' => $item['label'],
                    'value' => $val,
                    'pct' => $pct
                ];
            }
            @endphp

            <div class="brutal-card p-6 mt-8">
                <h3 class="font-black text-xl mb-4 flex items-center gap-2">
                    <span>💼</span> Mata Pencaharian Utama Warga
                </h3>
                <div class="space-y-4">
                    @foreach($pekerjaan as $p)
                        <div>
                            <div class="flex justify-between text-sm font-bold mb-1 text-[#212121] dark:text-gray-300">
                                <span>{{ $p['label'] }}</span>
                                <span class="text-[#2E7D32] font-black">{{ $p['value'] }} jiwa</span>
                            </div>
                            <div class="h-3.5 bg-gray-200 rounded-full border-2 border-[#212121] overflow-hidden">
                                <div class="h-full bg-[#2E7D32] rounded-full"
                                     style="width:{{ $p['pct'] }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function switchTab(activeTab) {
    // Hide all panels
    document.querySelectorAll('.tab-panel').forEach(function(panel) {
        panel.classList.add('hidden');
    });

    // Reset all buttons
    document.querySelectorAll('[data-tab]').forEach(function(btn) {
        btn.classList.remove('bg-[#2E7D32]', 'text-white');
        btn.classList.add('bg-white', 'text-[#212121]');
    });

    // Show target panel
    document.getElementById('tab-' + activeTab).classList.remove('hidden');

    // Activate target button
    var activeBtn = document.querySelector('[data-tab="' + activeTab + '"]');
    if (activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-[#212121]');
        activeBtn.classList.add('bg-[#2E7D32]', 'text-white');
    }
}

function openPerangkatModal(element) {
    const nama = element.getAttribute('data-nama');
    const jabatan = element.getAttribute('data-jabatan');
    const kontak = element.getAttribute('data-kontak');
    const foto = element.getAttribute('data-foto');

    document.getElementById('perangkatNama').textContent = nama;
    document.getElementById('perangkatJabatan').textContent = jabatan;
    document.getElementById('perangkatFoto').src = foto;
    document.getElementById('perangkatFoto').alt = nama;

    const waRow = document.getElementById('perangkatWaRow');
    if (kontak && kontak.trim() !== '') {
        const cleanWa = kontak.replace(/^0/, '62');
        document.getElementById('perangkatWaNum').textContent = kontak;
        document.getElementById('perangkatWaLink').href = 'https://wa.me/' + cleanWa;
        waRow.classList.remove('hidden');
    } else {
        waRow.classList.add('hidden');
    }

    const modal = document.getElementById('perangkatModal');
    const container = document.getElementById('perangkatModalContainer');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        container.classList.remove('scale-95');
    }, 10);
}

function closePerangkatModal() {
    const modal = document.getElementById('perangkatModal');
    const container = document.getElementById('perangkatModalContainer');
    
    container.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 150);
}

function handleClosePerangkatModal(e) {
    if (e.target.id === 'perangkatModal') {
        closePerangkatModal();
    }
}
</script>
@endpush

{{-- Modal Perangkat Desa --}}
<div id="perangkatModal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 hidden transition-opacity duration-300"
     onclick="handleClosePerangkatModal(event)">
    <div class="bg-white dark:bg-[#1e1e1e] border-4 border-[#212121] dark:border-gray-700 rounded-2xl shadow-[8px_8px_0_#212121] max-w-sm w-full overflow-hidden transform scale-95 transition-transform duration-300" 
         id="perangkatModalContainer">
        <div class="bg-[#2E7D32] p-4 text-white font-black flex justify-between items-center">
            <span>Detail Perangkat Desa</span>
            <button onclick="closePerangkatModal()" class="text-xl font-bold hover:text-gray-200">&times;</button>
        </div>
        <div class="p-6 text-center">
            <img id="perangkatFoto" src="" alt="" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-[#2E7D32] shadow-[3px_3px_0_#212121] object-cover" />
            <h3 id="perangkatNama" class="font-black text-lg text-slate-900 dark:text-white"></h3>
            <span id="perangkatJabatan" class="inline-block mt-1 bg-[#2E7D32] text-white text-xs font-bold px-3 py-1 rounded-full"></span>
            
            <div class="mt-6 text-left space-y-3 text-sm">
                <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-2" id="perangkatWaRow">
                    <span class="text-gray-500">WhatsApp</span>
                    <a id="perangkatWaLink" href="" target="_blank" class="font-bold text-[#2E7D32] hover:text-[#1B5E20] hover:underline flex items-center gap-1">
                        📞 <span id="perangkatWaNum"></span>
                    </a>
                </div>
            </div>
            
            <button onclick="closePerangkatModal()" class="mt-6 brutal-btn w-full bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold text-sm">
                Tutup
            </button>
        </div>
    </div>
</div>

@endsection
