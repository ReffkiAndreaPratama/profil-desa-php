@extends('layouts.public')

@section('title', 'KKN UNIB - Smart Village Talang Marap')

@section('content')

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Page header ── --}}
    @include('layouts.partials.page-header', [
        'title'    => 'KKN UNIB Periode 108',
        'subtitle' => 'Kelompok 146 · Desa Talang Marap',
    ])

    <div class="container-custom py-8">

        {{-- ── Kelompokkan anggota berdasarkan posisi ── --}}
        @php
        $struktural = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'];
        $divisiLabel = [
            'Bidang Pendidikan' => '📚',
            'Bidang Kesehatan'  => '🏥',
            'Bidang Lingkungan' => '🌿',
            'Bidang Ekonomi'    => '💼',
            'Acara'             => '🎉',
            'PDK'               => '📸',
            'Humas'             => '📢',
            'Perlengkapan'      => '🔧',
            'Konsumsi'          => '🍱',
            'Anggota'           => '👤',
        ];

        $pengurusList = $anggota->filter(fn($a) => in_array($a->posisi, $struktural));
        $divisiList   = $anggota->filter(fn($a) => !in_array($a->posisi, $struktural));

        // Group divisi by posisi
        $divisiGrouped = $divisiList->groupBy('posisi');
        @endphp

        {{-- ── Pengurus Inti ── --}}
        <div class="mb-10">
            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32]
                         text-xs font-black px-4 py-1 rounded-full mb-4">
                PENGURUS INTI
            </span>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($pengurusList as $a)
                    <div class="brutal-card p-5 text-center cursor-pointer hover:scale-[1.02] transition-transform duration-200"
                         onclick="openAnggotaModal(this)"
                         data-nama="{{ $a->nama }}"
                         data-posisi="{{ $a->posisi }}"
                         data-prodi="{{ $a->prodi }}"
                         data-fakultas="{{ $a->fakultas }}"
                         data-nim="{{ $a->nim }}"
                         data-foto="{{ \App\Helpers\FotoHelper::url($a->foto, 'https://ui-avatars.com/api/?name='.urlencode($a->nama).'&background=2E7D32&color=fff&size=200') }}"
                         data-instagram="{{ $a->instagram }}">
                        <img src="{{ \App\Helpers\FotoHelper::url($a->foto, 'https://ui-avatars.com/api/?name='.urlencode($a->nama).'&background=2E7D32&color=fff&size=200') }}"
                             alt="{{ $a->nama }}"
                             class="w-20 h-20 rounded-full mx-auto mb-3 border-4 border-[#2E7D32] object-cover"/>
                        <p class="font-black text-sm dark:text-gray-200">{{ $a->nama }}</p>
                        <span class="inline-block mt-1 bg-[#2E7D32] text-white text-[10px]
                                     font-bold px-2 py-0.5 rounded-full">
                            {{ $a->posisi }}
                        </span>
                        <p class="text-gray-400 text-[10px] mt-1">{{ $a->prodi }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ── Divisi / Bidang ── --}}
        @if($divisiGrouped->count() > 0)
        <div class="mb-12">
            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32]
                         text-xs font-black px-4 py-1 rounded-full mb-4">
                DIVISI & BIDANG
            </span>

            <div class="space-y-6">
                @foreach($divisiGrouped as $posisi => $anggotaDivisi)
                    <div>
                        {{-- Divisi header --}}
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xl">{{ $divisiLabel[$posisi] ?? '👥' }}</span>
                            <h3 class="font-black text-base text-[#212121] dark:text-gray-200">
                                {{ $posisi }}
                            </h3>
                            <span class="text-xs text-gray-400">({{ $anggotaDivisi->count() }} orang)</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            @foreach($anggotaDivisi as $a)
                                <div class="brutal-card p-4 text-center cursor-pointer hover:scale-[1.02] transition-transform duration-200"
                                     onclick="openAnggotaModal(this)"
                                     data-nama="{{ $a->nama }}"
                                     data-posisi="{{ $a->posisi }}"
                                     data-prodi="{{ $a->prodi }}"
                                     data-fakultas="{{ $a->fakultas }}"
                                     data-nim="{{ $a->nim }}"
                                     data-foto="{{ \App\Helpers\FotoHelper::url($a->foto, 'https://ui-avatars.com/api/?name='.urlencode($a->nama).'&background=43A047&color=fff&size=200') }}"
                                     data-instagram="{{ $a->instagram }}">
                                    <img src="{{ \App\Helpers\FotoHelper::url($a->foto, 'https://ui-avatars.com/api/?name='.urlencode($a->nama).'&background=43A047&color=fff&size=200') }}"
                                         alt="{{ $a->nama }}"
                                         class="w-14 h-14 rounded-full mx-auto mb-2 border-4 border-[#43A047] object-cover"/>
                                    <p class="font-black text-xs dark:text-gray-200">{{ $a->nama }}</p>
                                    <p class="text-gray-400 text-[10px] mt-0.5">{{ $a->prodi }}</p>
                                    @if($a->nim)
                                        <p class="text-gray-300 text-[9px]">{{ $a->nim }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @php
        $programKerja = $proker->filter(fn($p) => ($p->jenis ?? 'Program Kerja') === 'Program Kerja');
        $kegiatan = $proker->filter(fn($p) => ($p->jenis ?? '') === 'Kegiatan');
        @endphp

        {{-- ── Program Kerja ── --}}
        <div class="mb-12">
            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32]
                         text-xs font-black px-4 py-1 rounded-full mb-4">
                PROGRAM KERJA
            </span>
            <h2 class="text-2xl font-black mb-6">
                Program <span class="text-gradient">Kerja Utama</span>
            </h2>

            @if($programKerja->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($programKerja as $p)
                    <div class="brutal-card p-6 cursor-pointer hover:scale-[1.02] transition-transform duration-200"
                         onclick="openProkerModal(this)"
                         data-nama="{{ $p->nama }}"
                         data-jenis="{{ $p->jenis ?? 'Program Kerja' }}"
                         data-kategori="{{ $p->kategori }}"
                         data-deskripsi="{{ $p->deskripsi }}"
                         data-tujuan="{{ $p->tujuan }}"
                         data-manfaat="{{ $p->manfaat }}"
                         data-target="{{ $p->target }}"
                         data-output="{{ $p->output }}"
                         data-status="{{ $p->status }}"
                         data-progress="{{ $p->progress }}"
                         data-icon="{{ $p->icon ?? '📋' }}">
                        <div class="text-4xl mb-3">{{ $p->icon ?? '📋' }}</div>
                        <h3 class="font-black text-base mb-2 dark:text-gray-200">{{ $p->nama }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $p->deskripsi }}</p>
                        <div class="flex items-center justify-between text-xs font-bold mb-1">
                            <span class="dark:text-gray-300">Progress</span>
                            <span class="text-[#2E7D32]">{{ $p->progress }}%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full border-2 border-[#212121] overflow-hidden">
                            <div class="h-full bg-[#2E7D32] rounded-full"
                                 style="width:{{ $p->progress }}%">
                            </div>
                        </div>
                        @if($p->status)
                            @php
                            $statusColor = match($p->status) {
                                'completed' => 'bg-green-100 text-green-700',
                                'ongoing'   => 'bg-yellow-100 text-yellow-700',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                            $statusLabel = match($p->status) {
                                'completed' => '✅ Selesai',
                                'ongoing'   => '🔄 Berjalan',
                                default     => '📋 Planned',
                            };
                            @endphp
                            <span class="inline-block mt-3 text-xs px-2 py-1 rounded-full font-bold {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
            @else
                <div class="brutal-card p-12 text-center text-gray-400">
                    <p class="text-4xl mb-3">📋</p>
                    <p class="font-bold">Belum ada program kerja</p>
                </div>
            @endif
        </div>

        {{-- ── Kegiatan KKN ── --}}
        <div class="mb-12">
            <span class="inline-block bg-[#E8F5E9] border-2 border-[#2E7D32] text-[#2E7D32]
                         text-xs font-black px-4 py-1 rounded-full mb-4">
                KEGIATAN KKN
            </span>
            <h2 class="text-2xl font-black mb-6">
                Kegiatan <span class="text-gradient">Pendukung</span>
            </h2>

            @if($kegiatan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($kegiatan as $p)
                    <div class="brutal-card p-6 cursor-pointer hover:scale-[1.02] transition-transform duration-200"
                         onclick="openProkerModal(this)"
                         data-nama="{{ $p->nama }}"
                         data-jenis="{{ $p->jenis ?? 'Kegiatan' }}"
                         data-kategori="{{ $p->kategori }}"
                         data-deskripsi="{{ $p->deskripsi }}"
                         data-tujuan="{{ $p->tujuan }}"
                         data-manfaat="{{ $p->manfaat }}"
                         data-target="{{ $p->target }}"
                         data-output="{{ $p->output }}"
                         data-status="{{ $p->status }}"
                         data-progress="{{ $p->progress }}"
                         data-icon="{{ $p->icon ?? '🤝' }}">
                        <div class="text-4xl mb-3">{{ $p->icon ?? '🤝' }}</div>
                        <h3 class="font-black text-base mb-2 dark:text-gray-200">{{ $p->nama }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $p->deskripsi }}</p>
                        <div class="flex items-center justify-between text-xs font-bold mb-1">
                            <span class="dark:text-gray-300">Progress</span>
                            <span class="text-[#2E7D32]">{{ $p->progress }}%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full border-2 border-[#212121] overflow-hidden">
                            <div class="h-full bg-[#2E7D32] rounded-full"
                                 style="width:{{ $p->progress }}%">
                            </div>
                        </div>
                        @if($p->status)
                            @php
                            $statusColor = match($p->status) {
                                'completed' => 'bg-green-100 text-green-700',
                                'ongoing'   => 'bg-yellow-100 text-yellow-700',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                            $statusLabel = match($p->status) {
                                'completed' => '✅ Selesai',
                                'ongoing'   => '🔄 Berjalan',
                                default     => '📋 Planned',
                            };
                            @endphp
                            <span class="inline-block mt-3 text-xs px-2 py-1 rounded-full font-bold {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
            @else
                <div class="brutal-card p-12 text-center text-gray-400">
                    <p class="text-4xl mb-3">🤝</p>
                    <p class="font-bold">Belum ada kegiatan</p>
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Modal Preview Anggota KKN --}}
<div id="anggotaModal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 hidden transition-opacity duration-300"
     onclick="handleCloseAnggotaModal(event)">
    <div class="bg-white dark:bg-[#1e1e1e] border-4 border-[#212121] dark:border-gray-700 rounded-2xl shadow-[8px_8px_0_#212121] max-w-sm w-full overflow-hidden transform scale-95 transition-transform duration-300" 
         id="anggotaModalContainer">
        <div class="bg-[#2E7D32] p-4 text-white font-black flex justify-between items-center">
            <span>Detail Anggota KKN</span>
            <button onclick="closeAnggotaModal()" class="text-xl font-bold hover:text-gray-200">&times;</button>
        </div>
        <div class="p-6 text-center">
            <img id="modalFoto" src="" alt="" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-[#2E7D32] shadow-[3px_3px_0_#212121] object-cover" />
            <h3 id="modalNama" class="font-black text-lg text-slate-900 dark:text-white"></h3>
            <span id="modalPosisi" class="inline-block mt-1 bg-[#2E7D32] text-white text-xs font-bold px-3 py-1 rounded-full"></span>
            
            <div class="mt-6 text-left space-y-3 text-sm">
                <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-2">
                    <span class="text-gray-500">NIM</span>
                    <span id="modalNim" class="font-bold text-slate-800 dark:text-slate-200"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-2">
                    <span class="text-gray-500">Program Studi</span>
                    <span id="modalProdi" class="font-bold text-slate-800 dark:text-slate-200"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-2">
                    <span class="text-gray-500">Fakultas</span>
                    <span id="modalFakultas" class="font-bold text-slate-800 dark:text-slate-200"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 dark:border-gray-800 pb-2" id="modalIgRow">
                    <span class="text-gray-500">Instagram</span>
                    <a id="modalIgLink" href="" target="_blank" class="font-bold text-pink-600 hover:text-pink-700 hover:underline flex items-center gap-1">
                        📸 <span id="modalIgUser"></span>
                    </a>
                </div>
            </div>
            
            <button onclick="closeAnggotaModal()" class="mt-6 brutal-btn w-full bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold text-sm">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- Modal Preview Program Kerja / Kegiatan --}}
<div id="prokerModal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 hidden transition-opacity duration-300"
     onclick="handleCloseProkerModal(event)">
    <div class="bg-white dark:bg-[#1e1e1e] border-4 border-[#212121] dark:border-gray-700 rounded-2xl shadow-[8px_8px_0_#212121] max-w-lg w-full overflow-hidden transform scale-95 transition-transform duration-300" 
         id="prokerModalContainer">
        <div class="bg-[#2E7D32] p-4 text-white font-black flex justify-between items-center">
            <span id="modalProkerTitle">Detail Program Kerja</span>
            <button onclick="closeProkerModal()" class="text-xl font-bold hover:text-gray-200">&times;</button>
        </div>
        <div class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
            <div class="flex items-center gap-3">
                <span id="modalProkerIcon" class="text-4xl"></span>
                <div class="min-w-0 flex-1">
                    <h3 id="modalProkerNama" class="font-black text-base text-slate-900 dark:text-white leading-tight"></h3>
                    <div class="flex gap-2 mt-1.5">
                        <span id="modalProkerJenis" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400"></span>
                        <span id="modalProkerKategori" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400"></span>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-2 text-sm text-slate-700 dark:text-slate-300">
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">📝 Deskripsi & Sasaran</h4>
                    <p id="modalProkerDesc" class="mt-1 bg-gray-50 dark:bg-gray-800 p-3 rounded-xl border-2 border-gray-100 dark:border-gray-800 text-xs leading-relaxed"></p>
                </div>
                <div id="modalProkerTujuanRow">
                    <h4 class="font-bold text-slate-900 dark:text-white">🎯 Tujuan</h4>
                    <p id="modalProkerTujuan" class="mt-1 bg-gray-50 dark:bg-gray-800 p-3 rounded-xl border-2 border-gray-100 dark:border-gray-800 text-xs leading-relaxed"></p>
                </div>
                <div id="modalProkerManfaatRow">
                    <h4 class="font-bold text-slate-900 dark:text-white">✨ Manfaat</h4>
                    <p id="modalProkerManfaat" class="mt-1 bg-gray-50 dark:bg-gray-800 p-3 rounded-xl border-2 border-gray-100 dark:border-gray-800 text-xs leading-relaxed"></p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 pt-1">
                    <div>
                        <span class="text-[10px] text-gray-400 font-bold block uppercase tracking-wider">👥 Target</span>
                        <span id="modalProkerTarget" class="font-semibold text-slate-800 dark:text-slate-200 text-xs"></span>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 font-bold block uppercase tracking-wider">Output</span>
                        <span id="modalProkerOutput" class="font-semibold text-slate-800 dark:text-slate-200 text-xs"></span>
                    </div>
                </div>

                <div class="pt-2">
                    <div class="flex justify-between items-center text-xs font-bold mb-1">
                        <span>Progress Pelaksanaan</span>
                        <span id="modalProkerProgressVal" class="text-[#2E7D32]"></span>
                    </div>
                    <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded-full border-2 border-[#212121] dark:border-gray-600 overflow-hidden">
                        <div id="modalProkerProgressBar" class="h-full bg-[#2E7D32] rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <button onclick="closeProkerModal()" class="mt-6 brutal-btn w-full bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold text-sm">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openAnggotaModal(element) {
    const nama = element.getAttribute('data-nama');
    const posisi = element.getAttribute('data-posisi');
    const prodi = element.getAttribute('data-prodi');
    const fakultas = element.getAttribute('data-fakultas');
    const nim = element.getAttribute('data-nim') || '-';
    const foto = element.getAttribute('data-foto');
    const instagram = element.getAttribute('data-instagram');

    document.getElementById('modalNama').textContent = nama;
    document.getElementById('modalPosisi').textContent = posisi;
    document.getElementById('modalProdi').textContent = prodi;
    document.getElementById('modalFakultas').textContent = fakultas;
    document.getElementById('modalNim').textContent = nim;
    document.getElementById('modalFoto').src = foto;
    document.getElementById('modalFoto').alt = nama;

    const igRow = document.getElementById('modalIgRow');
    if (instagram && instagram.trim() !== '') {
        document.getElementById('modalIgUser').textContent = '@' + instagram;
        document.getElementById('modalIgLink').href = 'https://instagram.com/' + instagram;
        igRow.classList.remove('hidden');
    } else {
        igRow.classList.add('hidden');
    }

    const modal = document.getElementById('anggotaModal');
    const container = document.getElementById('anggotaModalContainer');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        container.classList.remove('scale-95');
    }, 10);
}

function closeAnggotaModal() {
    const modal = document.getElementById('anggotaModal');
    const container = document.getElementById('anggotaModalContainer');
    
    container.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 150);
}

function handleCloseAnggotaModal(e) {
    if (e.target.id === 'anggotaModal') {
        closeAnggotaModal();
    }
}

function openProkerModal(element) {
    const nama = element.getAttribute('data-nama');
    const jenis = element.getAttribute('data-jenis');
    const kategori = element.getAttribute('data-kategori');
    const deskripsi = element.getAttribute('data-deskripsi');
    const tujuan = element.getAttribute('data-tujuan');
    const manfaat = element.getAttribute('data-manfaat');
    const target = element.getAttribute('data-target') || '-';
    const output = element.getAttribute('data-output') || '-';
    const progress = element.getAttribute('data-progress') || '0';
    const icon = element.getAttribute('data-icon');

    document.getElementById('modalProkerNama').textContent = nama;
    document.getElementById('modalProkerJenis').textContent = jenis;
    document.getElementById('modalProkerKategori').textContent = kategori;
    document.getElementById('modalProkerDesc').textContent = deskripsi;
    document.getElementById('modalProkerTarget').textContent = target;
    document.getElementById('modalProkerOutput').textContent = output;
    document.getElementById('modalProkerIcon').textContent = icon;
    document.getElementById('modalProkerProgressVal').textContent = progress + '%';
    document.getElementById('modalProkerProgressBar').style.width = progress + '%';

    document.getElementById('modalProkerTitle').textContent = 'Detail ' + jenis;

    // Tujuan
    const tujuanRow = document.getElementById('modalProkerTujuanRow');
    if (tujuan && tujuan.trim() !== '') {
        document.getElementById('modalProkerTujuan').textContent = tujuan;
        tujuanRow.classList.remove('hidden');
    } else {
        tujuanRow.classList.add('hidden');
    }

    // Manfaat
    const manfaatRow = document.getElementById('modalProkerManfaatRow');
    if (manfaat && manfaat.trim() !== '') {
        document.getElementById('modalProkerManfaat').textContent = manfaat;
        manfaatRow.classList.remove('hidden');
    } else {
        manfaatRow.classList.add('hidden');
    }

    const modal = document.getElementById('prokerModal');
    const container = document.getElementById('prokerModalContainer');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        container.classList.remove('scale-95');
    }, 10);
}

function closeProkerModal() {
    const modal = document.getElementById('prokerModal');
    const container = document.getElementById('prokerModalContainer');
    
    container.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 150);
}

function handleCloseProkerModal(e) {
    if (e.target.id === 'prokerModal') {
        closeProkerModal();
    }
}
</script>
@endpush

@endsection
