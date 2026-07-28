@extends('layouts.admin')

@section('title', 'Peta Rumah')
@section('page_title', 'Peta & Pemetaan Rumah')

@section('content')

{{-- ── Toolbar ── --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <form method="GET" class="flex gap-2 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari no. rumah / nama KK..."
               class="px-4 py-2 border-2 border-[#212121] rounded-xl text-sm outline-none focus:border-[#2E7D32]"/>
        <select name="dusun" class="px-4 py-2 border-2 border-[#212121] rounded-xl text-sm bg-white outline-none focus:border-[#2E7D32]">
            <option value="">Semua Dusun</option>
            @foreach($dusuns as $d)
                <option value="{{ $d }}" {{ request('dusun') === $d ? 'selected' : '' }}>{{ $d }}</option>
            @endforeach
        </select>
        <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl text-sm">
            Cari
        </button>
    </form>
    <a href="{{ route('admin.peta-rumah.create') }}"
       class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
        + Tambah Rumah
    </a>
</div>

{{-- ── Mini map preview ── --}}
<div class="brutal-card overflow-hidden mb-6" style="height:300px">
    <div id="adminMap" class="w-full h-full"></div>
</div>

{{-- ── Data table ── --}}
<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

    <div class="bg-[#2E7D32] p-4 flex items-center justify-between">
        <h3 class="font-black text-white">🏠 Daftar Rumah ({{ $rumah->total() }})</h3>
        <span class="text-white/70 text-sm">Total jiwa: {{ \App\Models\PetaRumah::where('aktif', true)->sum('jumlah_jiwa') }}</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b-2 border-[#212121]">
                <tr>
                    <th class="px-4 py-3 text-left font-black">No.</th>
                    <th class="px-4 py-3 text-left font-black">No. Rumah</th>
                    <th class="px-4 py-3 text-left font-black">Nama KK</th>
                    <th class="px-4 py-3 text-left font-black">RT/RW</th>
                    <th class="px-4 py-3 text-left font-black">Dusun</th>
                    <th class="px-4 py-3 text-center font-black">Jiwa</th>
                    <th class="px-4 py-3 text-left font-black">Koordinat</th>
                    <th class="px-4 py-3 text-left font-black">Status</th>
                    <th class="px-4 py-3 text-left font-black">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($rumah as $r)
                    <tr class="hover:bg-gray-50 {{ !$r->aktif ? 'opacity-50' : '' }}">
                        <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            <span class="bg-[#2E7D32] text-white text-xs font-black px-2 py-1 rounded-lg">
                                {{ $r->no_rumah }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ $r->nama_kk }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">
                            {{ $r->rt ? 'RT '.$r->rt : '' }}
                            {{ $r->rw ? '/ RW '.$r->rw : '' }}
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $r->dusun ?? '-' }}</td>
                        <td class="px-4 py-3 text-center font-bold">{{ $r->jumlah_jiwa }}</td>
                        <td class="px-4 py-3 font-mono text-xs text-gray-400">
                            {{ number_format($r->lat, 5) }}, {{ number_format($r->lng, 5) }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full font-bold
                                         {{ $r->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $r->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.peta-rumah.edit', $r->id) }}"
                                   class="brutal-btn bg-blue-500 text-white px-3 py-1.5 rounded-lg text-xs">
                                    ✏️
                                </a>
                                <form id="del-rumah-{{ $r->id }}"
                                      action="{{ route('admin.peta-rumah.destroy', $r->id) }}"
                                      method="POST"
                                      style="display:none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button"
                                        onclick="showDeleteModal(document.getElementById('del-rumah-{{ $r->id }}'), 'Hapus Rumah', 'Hapus rumah No. {{ $r->no_rumah }} - {{ addslashes($r->nama_kk) }}?')"
                                        class="brutal-btn bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs">
                                    🗑️
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-2">🏠</p>
                            <p>Belum ada data rumah. <a href="{{ route('admin.peta-rumah.create') }}" class="text-[#2E7D32] font-bold">Tambah sekarang →</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-gray-200">{{ $rumah->links() }}</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function() {
    // Default center dari koordinat desa
    var map = L.map('adminMap').setView([-4.35, 103.12], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Load rumah dari GeoJSON endpoint
    fetch('{{ route("admin.peta-rumah.geojson") }}')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var markers = L.featureGroup();

            data.features.forEach(function(f) {
                var p   = f.properties;
                var lat = f.geometry.coordinates[1];
                var lng = f.geometry.coordinates[0];

                var icon = L.divIcon({
                    html: '<div style="background:#2E7D32;color:white;border:2px solid #212121;'
                        + 'border-radius:6px;padding:2px 5px;font-size:10px;font-weight:900;'
                        + 'white-space:nowrap;box-shadow:2px 2px 0 #212121;">'
                        + p.no_rumah + '</div>',
                    className: '',
                    iconAnchor: [12, 12],
                });

                var marker = L.marker([lat, lng], { icon: icon });
                marker.bindPopup(
                    '<b style="font-size:13px">🏠 No. ' + p.no_rumah + '</b><br>'
                    + '<span style="font-size:12px">KK: ' + p.nama_kk + '</span><br>'
                    + (p.dusun ? '<span style="font-size:11px;color:#666">Dusun ' + p.dusun + '</span><br>' : '')
                    + '<span style="font-size:11px;color:#666">' + p.jumlah_jiwa + ' jiwa</span>'
                );
                markers.addLayer(marker);
            });

            markers.addTo(map);

            // Fit map to markers if any
            if (data.features.length > 0) {
                map.fitBounds(markers.getBounds().pad(0.1));
            }
        });
})();
</script>
@endpush
