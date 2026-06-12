@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @php
    $cards = [
        ['icon'=>'📰','label'=>'Total Berita','value'=>$stats['berita'],'color'=>'blue','route'=>'admin.berita.index'],
        ['icon'=>'⛰️','label'=>'Wisata','value'=>$stats['wisata'],'color'=>'green','route'=>'admin.wisata.index'],
        ['icon'=>'🛍️','label'=>'UMKM','value'=>$stats['umkm'],'color'=>'purple','route'=>'admin.umkm.index'],
        ['icon'=>'🖼️','label'=>'Galeri','value'=>$stats['galeri'],'color'=>'orange','route'=>'admin.galeri.index'],
        ['icon'=>'💬','label'=>'Aspirasi Baru','value'=>$stats['aspirasi_baru'],'color'=>'red','route'=>'admin.aspirasi.index'],
        ['icon'=>'⚠️','label'=>'Laporan Sampah','value'=>$stats['laporan_baru'],'color'=>'yellow','route'=>'admin.laporan-sampah.index'],
        ['icon'=>'♻️','label'=>'Nasabah Aktif','value'=>$stats['nasabah'],'color'=>'emerald','route'=>'admin.bank-sampah.index'],
        ['icon'=>'✉️','label'=>'Pesan Belum Dibaca','value'=>$stats['pesan_baru'],'color'=>'cyan','route'=>'admin.pesan-kontak.index'],
    ];
    @endphp
    @foreach($cards as $card)
    <a href="{{ route($card['route']) }}" class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 hover:shadow-[6px_6px_0_#212121] hover:-translate-x-[2px] hover:-translate-y-[2px] transition-all">
        <div class="text-2xl mb-2">{{ $card['icon'] }}</div>
        <p class="text-2xl font-black text-[#212121]">{{ $card['value'] }}</p>
        <p class="text-gray-500 text-xs font-medium mt-1">{{ $card['label'] }}</p>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Berita Terbaru -->
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
        <div class="bg-[#2E7D32] p-4 flex items-center justify-between">
            <h3 class="font-black text-white">📰 Berita Terbaru</h3>
            <a href="{{ route('admin.berita.index') }}" class="text-white/80 text-xs hover:text-white">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($beritaTerbaru as $b)
            <div class="p-4 flex items-center gap-3">
                <div class="w-10 h-10 bg-[#E8F5E9] rounded-lg flex items-center justify-center shrink-0 text-sm">📰</div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm truncate">{{ $b->judul }}</p>
                    <p class="text-gray-400 text-xs">{{ $b->tanggal->format('d M Y') }} · {{ $b->views }} views</p>
                </div>
                <span class="text-xs {{ $b->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} px-2 py-1 rounded-full font-semibold shrink-0">
                    {{ $b->published ? 'Publik' : 'Draft' }}
                </span>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 text-sm">Belum ada berita</div>
            @endforelse
        </div>
    </div>

    <!-- Aspirasi Terbaru -->
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
        <div class="bg-[#212121] p-4 flex items-center justify-between">
            <h3 class="font-black text-white">💬 Aspirasi Terbaru</h3>
            <a href="{{ route('admin.aspirasi.index') }}" class="text-white/80 text-xs hover:text-white">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($aspirasiTerbaru as $a)
            <div class="p-4 flex items-center gap-3">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 font-black text-sm">
                    {{ $a->anonim ? '👤' : strtoupper(substr($a->nama, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm">{{ $a->anonim ? 'Anonim' : $a->nama }}</p>
                    <p class="text-gray-400 text-xs truncate">{{ $a->pesan }}</p>
                </div>
                @php
                $statusColors = ['diterima'=>'bg-blue-100 text-blue-700','diproses'=>'bg-yellow-100 text-yellow-700','selesai'=>'bg-green-100 text-green-700','ditolak'=>'bg-red-100 text-red-700'];
                @endphp
                <span class="text-xs {{ $statusColors[$a->status] ?? 'bg-gray-100 text-gray-600' }} px-2 py-1 rounded-full font-semibold shrink-0">
                    {{ ucfirst($a->status) }}
                </span>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 text-sm">Belum ada aspirasi</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <a href="{{ route('admin.berita.create') }}" class="bg-[#2E7D32] text-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 text-center hover:shadow-[6px_6px_0_#212121] hover:-translate-x-[2px] hover:-translate-y-[2px] transition-all font-bold text-sm">
        ✏️<br>Tulis Berita
    </a>
    <a href="{{ route('admin.galeri.create') }}" class="bg-[#43A047] text-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 text-center hover:shadow-[6px_6px_0_#212121] hover:-translate-x-[2px] hover:-translate-y-[2px] transition-all font-bold text-sm">
        🖼️<br>Tambah Foto
    </a>
    <a href="{{ route('admin.agenda.create') }}" class="bg-[#1565C0] text-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 text-center hover:shadow-[6px_6px_0_#212121] hover:-translate-x-[2px] hover:-translate-y-[2px] transition-all font-bold text-sm">
        📅<br>Tambah Agenda
    </a>
    <a href="{{ route('admin.pengaturan.index') }}" class="bg-[#212121] text-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#2E7D32] p-4 text-center hover:shadow-[6px_6px_0_#2E7D32] hover:-translate-x-[2px] hover:-translate-y-[2px] transition-all font-bold text-sm">
        ⚙️<br>Pengaturan
    </a>
</div>
@endsection
