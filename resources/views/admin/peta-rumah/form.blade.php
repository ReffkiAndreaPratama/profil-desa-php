@extends('layouts.admin')

@section('title', isset($rumah) ? 'Edit Rumah' : 'Tambah Rumah')
@section('page_title', isset($rumah) ? 'Edit Data Rumah' : 'Tambah Data Rumah')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- ── Form ── --}}
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">

        <div class="bg-[#2E7D32] p-4">
            <h3 class="font-black text-white">
                🏠 {{ isset($rumah) ? 'Edit' : 'Tambah' }} Data Rumah
            </h3>
        </div>

        <form action="{{ isset($rumah) ? route('admin.peta-rumah.update', $rumah->id) : route('admin.peta-rumah.store') }}"
              method="POST"
              class="p-6 space-y-4">
            @csrf
            @if(isset($rumah)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">No. Rumah *</label>
                    <input type="text" name="no_rumah"
                           value="{{ old('no_rumah', $rumah->no_rumah ?? '') }}"
                           required placeholder="001"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                    @error('no_rumah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Jumlah Jiwa</label>
                    <input type="number" name="jumlah_jiwa" min="1"
                           value="{{ old('jumlah_jiwa', $rumah->jumlah_jiwa ?? 1) }}"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Nama Kepala Keluarga *</label>
                <input type="text" name="nama_kk"
                       value="{{ old('nama_kk', $rumah->nama_kk ?? '') }}"
                       required placeholder="Nama KK"
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                @error('nama_kk')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Alamat</label>
                <input type="text" name="alamat"
                       value="{{ old('alamat', $rumah->alamat ?? '') }}"
                       placeholder="Jl. ..."
                       class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-2">RT</label>
                    <input type="text" name="rt"
                           value="{{ old('rt', $rumah->rt ?? '') }}"
                           placeholder="001"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">RW</label>
                    <input type="text" name="rw"
                           value="{{ old('rw', $rumah->rw ?? '') }}"
                           placeholder="001"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Dusun</label>
                    <input type="text" name="dusun"
                           value="{{ old('dusun', $rumah->dusun ?? '') }}"
                           placeholder="Dusun I"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Status Rumah</label>
                <select name="status_rumah"
                        class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                    @foreach(['tetap' => 'Tetap', 'kontrak' => 'Kontrak/Sewa', 'milik_orang_lain' => 'Milik Orang Lain'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status_rumah', $rumah->status_rumah ?? 'tetap') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ── Koordinat — klik peta atau isi manual ── --}}
            <div class="bg-[#E8F5E9] border-2 border-[#2E7D32] rounded-xl p-4">
                <p class="font-bold text-sm text-[#2E7D32] mb-3">
                    📍 Koordinat — Klik pada peta untuk mengisi otomatis
                </p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-xs mb-1">Latitude *</label>
                        <input type="text" name="lat" id="inputLat"
                               value="{{ old('lat', $rumah->lat ?? '') }}"
                               required placeholder="-4.35000"
                               class="w-full px-3 py-2 border-[2px] border-[#2E7D32] rounded-lg outline-none text-sm font-mono"/>
                        @error('lat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-bold text-xs mb-1">Longitude *</label>
                        <input type="text" name="lng" id="inputLng"
                               value="{{ old('lng', $rumah->lng ?? '') }}"
                               required placeholder="103.12000"
                               class="w-full px-3 py-2 border-[2px] border-[#2E7D32] rounded-lg outline-none text-sm font-mono"/>
                        @error('lng')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Keterangan</label>
                <textarea name="keterangan" rows="2"
                          class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none">{{ old('keterangan', $rumah->keterangan ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border-2 border-gray-200">
                <input type="hidden" name="aktif" value="0"/>
                <input type="checkbox" name="aktif" id="aktif" value="1"
                       {{ old('aktif', $rumah->aktif ?? true) ? 'checked' : '' }} class="w-4 h-4"/>
                <label for="aktif" class="font-bold text-sm cursor-pointer">Tampilkan di peta publik</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">
                    💾 Simpan
                </button>
                <a href="{{ route('admin.peta-rumah.index') }}"
                   class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- ── Interactive map untuk pilih koordinat ── --}}
    <div>
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <div class="bg-[#212121] p-3">
                <p class="text-white font-black text-sm">🗺️ Klik peta untuk set koordinat rumah</p>
                <p class="text-gray-400 text-xs">Scroll untuk zoom, drag untuk geser</p>
            </div>
            <div id="pickMap" style="height:450px"></div>
        </div>
        <div id="coordInfo" class="mt-3 p-3 bg-[#E8F5E9] border-2 border-[#2E7D32] rounded-xl text-sm text-[#2E7D32] font-mono hidden">
            📍 <span id="coordText"></span>
        </div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function() {
    var initLat = parseFloat(document.getElementById('inputLat').value) || -4.35;
    var initLng = parseFloat(document.getElementById('inputLng').value) || 103.12;
    var zoom    = document.getElementById('inputLat').value ? 17 : 14;

    var map = L.map('pickMap').setView([initLat, initLng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Existing marker if editing
    var marker = null;
    if (document.getElementById('inputLat').value) {
        marker = L.marker([initLat, initLng], { draggable: true }).addTo(map);
        marker.on('dragend', updateCoords);
    }

    // Click to place / move marker
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', updateCoords);
        }

        setCoords(lat, lng);
    });

    function updateCoords(e) {
        var pos = e.target.getLatLng();
        setCoords(pos.lat, pos.lng);
    }

    function setCoords(lat, lng) {
        document.getElementById('inputLat').value = lat.toFixed(7);
        document.getElementById('inputLng').value = lng.toFixed(7);
        document.getElementById('coordText').textContent = lat.toFixed(7) + ', ' + lng.toFixed(7);
        document.getElementById('coordInfo').classList.remove('hidden');
    }

    // Load existing rumah pins as reference
    fetch('{{ route("admin.peta-rumah.geojson") }}')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            data.features.forEach(function(f) {
                var p   = f.properties;
                var lat = f.geometry.coordinates[1];
                var lng = f.geometry.coordinates[0];

                // Skip current editing marker
                @if(isset($rumah))
                if (p.id === {{ $rumah->id }}) return;
                @endif

                var icon = L.divIcon({
                    html: '<div style="background:#666;color:white;border:1px solid #333;'
                        + 'border-radius:4px;padding:1px 4px;font-size:9px;font-weight:bold">'
                        + p.no_rumah + '</div>',
                    className: '',
                    iconAnchor: [10, 10],
                });
                L.marker([lat, lng], { icon: icon }).addTo(map)
                    .bindTooltip(p.no_rumah + ' - ' + p.nama_kk, { permanent: false });
            });
        });
})();
</script>
@endpush
