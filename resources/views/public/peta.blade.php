@extends('layouts.public')

@section('title', 'Peta Desa — Desa Talang Marap')

@section('content')
@php
    $mapsUrl   = $desa['maps_desa']      ?? null;
    $koordinat = $desa['koordinat_desa'] ?? '-4.35, 103.12';
    $coords    = explode(',', $koordinat);
    $lat       = isset($coords[0]) ? trim($coords[0]) : '-4.35';
    $lng       = isset($coords[1]) ? trim($coords[1]) : '103.12';
    $mapsLink  = $mapsUrl ?: 'https://www.google.com/maps?q=' . $lat . ',' . $lng;
    $namaDesa  = $desa['nama_desa']  ?? 'Talang Marap';
    $kecamatan = $desa['kecamatan'] ?? 'Kec. Kelam Tengah';
    $kabupaten = $desa['kabupaten'] ?? 'Kab. Kaur';
@endphp

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Header ── --}}
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-white mb-1" data-i18n="peta_judul">Peta Interaktif</h1>
                <p class="text-white/70">{{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}</p>
            </div>
            <a href="{{ $mapsLink }}" target="_blank" rel="noopener"
               class="brutal-btn inline-flex items-center gap-2 bg-white text-[#212121]
                      px-5 py-3 rounded-xl font-black text-sm self-start">
                🗺️ <span data-i18n="peta_buka_maps">Buka di Google Maps</span>
            </a>
        </div>
    </div>

    <div class="container-custom py-8 space-y-6">

        {{-- ── Layer toggle ── --}}
        <div class="flex gap-3 flex-wrap">
            <button id="btnLayerDesa" onclick="setLayer('desa')"
                    class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
                🏡 Titik Desa
            </button>
            <button id="btnLayerRumah" onclick="setLayer('rumah')"
                    class="brutal-btn bg-white text-[#212121] px-4 py-2 rounded-xl font-bold text-sm">
                🏠 Peta Rumah
            </button>
            <button id="btnLayerSemua" onclick="setLayer('semua')"
                    class="brutal-btn bg-white text-[#212121] px-4 py-2 rounded-xl font-bold text-sm">
                🗺️ Semua
            </button>
            {{-- Search rumah --}}
            <div class="flex items-center gap-2 ml-auto">
                <input type="text" id="searchRumah" placeholder="Cari no. rumah / nama KK..."
                       oninput="filterMarkers(this.value)"
                       class="px-4 py-2 border-[3px] border-[#212121] rounded-xl text-sm
                              outline-none focus:border-[#2E7D32] w-48"/>
            </div>
        </div>

        {{-- ── Main map ── --}}
        <div class="brutal-card dark:border-gray-600 overflow-hidden" style="height: 520px">
            <div id="map" class="w-full h-full"></div>
        </div>

        {{-- ── Info cards ── --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="brutal-card dark:bg-[#1e1e1e] dark:border-gray-600 p-4 text-center">
                <p class="text-2xl">📍</p>
                <p class="font-bold text-sm mt-1 dark:text-gray-200">{{ $kecamatan }}</p>
            </div>
            <div class="brutal-card dark:bg-[#1e1e1e] dark:border-gray-600 p-4 text-center">
                <p class="text-2xl">🗺️</p>
                <p class="font-bold text-sm mt-1 dark:text-gray-200">{{ $kabupaten }}</p>
            </div>
            <div class="brutal-card dark:bg-[#1e1e1e] dark:border-gray-600 p-4 text-center">
                <p class="text-2xl">🏘️</p>
                <p class="font-bold text-sm mt-1 dark:text-gray-200">
                    {{ $desa['jumlah_dusun'] ?? '—' }} <span data-i18n="peta_dusun">Dusun</span>
                </p>
            </div>
            <div class="brutal-card dark:bg-[#1e1e1e] dark:border-gray-600 p-4 text-center">
                <p class="text-2xl">🏠</p>
                <p class="font-bold text-sm mt-1 dark:text-gray-200" id="totalRumah">
                    Memuat...
                </p>
                <p class="text-gray-400 text-xs">Total Rumah</p>
            </div>
        </div>

        {{-- ── Coordinates bar ── --}}
        <div class="brutal-card dark:bg-[#1e1e1e] dark:border-gray-600 p-4
                    flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <span class="text-2xl">🧭</span>
                <div>
                    <p class="font-bold text-sm dark:text-gray-200" data-i18n="peta_koordinat_label">
                        Koordinat Desa
                    </p>
                    <p class="text-gray-500 text-xs font-mono">{{ $koordinat }}</p>
                </div>
            </div>
            <a href="{{ $mapsLink }}" target="_blank" rel="noopener"
               class="brutal-btn inline-flex items-center gap-2 bg-[#1565C0] text-white
                      px-4 py-2 rounded-xl font-bold text-sm">
                📍 <span data-i18n="peta_navigasi">Navigasi ke Sini</span>
            </a>
        </div>

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    .dark .leaflet-tile { filter: brightness(0.65) invert(0.05); }
    .rumah-label {
        background: #2E7D32;
        color: white;
        border: 2px solid #212121;
        border-radius: 6px;
        padding: 2px 6px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
        box-shadow: 2px 2px 0 #212121;
        cursor: pointer;
    }
    .rumah-label:hover { background: #1B5E20; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function () {
    var lat     = {{ $lat }};
    var lng     = {{ $lng }};
    var desaName = '{{ $namaDesa }}';
    var mapsLink = '{{ $mapsLink }}';

    var map = L.map('map').setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // ── Desa center pin ──────────────────────────────────
    var desaIcon = L.divIcon({
        html: '<div style="background:#2E7D32;border:3px solid #212121;border-radius:50% 50% 50% 0;'
            + 'width:36px;height:36px;transform:rotate(-45deg);display:flex;align-items:center;'
            + 'justify-content:center;box-shadow:3px 3px 0 #212121;">'
            + '<span style="transform:rotate(45deg);font-size:18px;display:block;line-height:30px;text-align:center;">🏡</span></div>',
        className: '', iconSize: [36,36], iconAnchor: [18,36], popupAnchor: [0,-36],
    });

    var desaMarker = L.marker([lat, lng], { icon: desaIcon });
    desaMarker.bindPopup(
        '<b style="font-size:14px">' + desaName + '</b><br>'
        + '<a href="' + mapsLink + '" target="_blank" style="color:#2E7D32;font-weight:bold;font-size:12px">'
        + '🗺️ Buka di Google Maps</a>'
    ).openPopup();

    // ── Rumah markers ────────────────────────────────────
    var rumahLayer   = L.featureGroup();
    var allMarkers   = []; // [{marker, props}] for filtering
    var currentLayer = 'semua';

    fetch('{{ route("peta.rumah.geojson") }}')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            document.getElementById('totalRumah').textContent = data.features.length + ' Rumah';

            data.features.forEach(function(f) {
                var p   = f.properties;
                var rlat = f.geometry.coordinates[1];
                var rlng = f.geometry.coordinates[0];

                var icon = L.divIcon({
                    html: '<div class="rumah-label">' + p.no_rumah + '</div>',
                    className: '', iconAnchor: [15, 10],
                });

                var m = L.marker([rlat, rlng], { icon: icon });
                m.bindPopup(
                    '<div style="min-width:160px">'
                    + '<b style="font-size:13px">🏠 No. ' + p.no_rumah + '</b><br>'
                    + '<table style="font-size:11px;margin-top:4px;line-height:1.8">'
                    + '<tr><td style="color:#666">KK</td><td>&nbsp;: <b>' + p.nama_kk + '</b></td></tr>'
                    + (p.dusun   ? '<tr><td style="color:#666">Dusun</td><td>&nbsp;: ' + p.dusun + '</td></tr>' : '')
                    + (p.rt      ? '<tr><td style="color:#666">RT/RW</td><td>&nbsp;: ' + p.rt + '/' + p.rw + '</td></tr>' : '')
                    + '<tr><td style="color:#666">Jiwa</td><td>&nbsp;: ' + p.jumlah_jiwa + '</td></tr>'
                    + '</table></div>'
                );

                rumahLayer.addLayer(m);
                allMarkers.push({ marker: m, props: p });
            });

            applyLayer(currentLayer);
        });

    // ── Layer control ────────────────────────────────────
    window.setLayer = function(mode) {
        currentLayer = mode;
        applyLayer(mode);

        // Update button styles
        ['Desa','Rumah','Semua'].forEach(function(n) {
            var btn = document.getElementById('btnLayer' + n);
            if (btn) {
                btn.className = btn.className
                    .replace('bg-[#2E7D32] text-white', 'bg-white text-[#212121]');
            }
        });
        var active = document.getElementById('btnLayer' + mode.charAt(0).toUpperCase() + mode.slice(1));
        if (active) {
            active.className = active.className
                .replace('bg-white text-[#212121]', 'bg-[#2E7D32] text-white');
        }
    };

    function applyLayer(mode) {
        if (mode === 'desa' || mode === 'semua') {
            if (!map.hasLayer(desaMarker)) desaMarker.addTo(map);
        } else {
            map.removeLayer(desaMarker);
        }

        if (mode === 'rumah' || mode === 'semua') {
            if (!map.hasLayer(rumahLayer)) rumahLayer.addTo(map);
        } else {
            map.removeLayer(rumahLayer);
        }
    }

    // ── Search / filter ──────────────────────────────────
    window.filterMarkers = function(q) {
        q = q.toLowerCase().trim();
        rumahLayer.clearLayers();

        allMarkers.forEach(function(item) {
            var p = item.props;
            if (!q
                || p.no_rumah.toLowerCase().includes(q)
                || p.nama_kk.toLowerCase().includes(q)
                || (p.dusun && p.dusun.toLowerCase().includes(q))
            ) {
                rumahLayer.addLayer(item.marker);
            }
        });

        // Fit to filtered results
        if (rumahLayer.getLayers().length > 0) {
            map.fitBounds(rumahLayer.getBounds().pad(0.1));
        }
    };

    // ── i18n ─────────────────────────────────────────────
    if (typeof _translations !== 'undefined') {
        _translations['peta_judul']           = { ID: 'Peta Interaktif',     EN: 'Interactive Map' };
        _translations['peta_buka_maps']       = { ID: 'Buka di Google Maps', EN: 'Open in Google Maps' };
        _translations['peta_dusun']           = { ID: 'Dusun',               EN: 'Hamlets' };
        _translations['peta_koordinat_label'] = { ID: 'Koordinat Desa',      EN: 'Village Coordinates' };
        _translations['peta_navigasi']        = { ID: 'Navigasi ke Sini',    EN: 'Navigate Here' };
    }
    if (typeof applyLang === 'function') applyLang(localStorage.getItem('lang') || 'ID');

    // Init layer
    applyLayer('semua');
})();
</script>
@endpush
