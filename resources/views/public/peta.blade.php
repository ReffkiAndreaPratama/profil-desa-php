@extends('layouts.public')
@section('title', 'Peta Interaktif')
@section('content')
<div class="min-h-screen bg-[#FFFDF7] pt-24">
    <div class="gradient-green border-b-4 border-[#212121] py-10">
        <div class="container-custom"><h1 class="text-3xl font-black text-white mb-1">Peta Interaktif</h1><p class="text-white/70">Peta wilayah Desa Talang Marap</p></div>
    </div>
    <div class="container-custom py-8">
        <div class="brutal-card overflow-hidden" style="height:500px">
            <div id="map" class="w-full h-full"></div>
        </div>
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="brutal-card p-4 text-center"><p class="text-2xl">📍</p><p class="font-bold text-sm mt-1">Kec. Kelam Tengah</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-2xl">🗺️</p><p class="font-bold text-sm mt-1">Kab. Kaur</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-2xl">🏘️</p><p class="font-bold text-sm mt-1">4 Dusun</p></div>
            <div class="brutal-card p-4 text-center"><p class="text-2xl">📐</p><p class="font-bold text-sm mt-1">24.5 km²</p></div>
        </div>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-4.35, 103.12], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution:'© OpenStreetMap'}).addTo(map);
    L.marker([-4.35, 103.12]).addTo(map).bindPopup('<b>Desa Talang Marap</b><br>Kec. Kelam Tengah, Kab. Kaur').openPopup();
</script>
@endpush
@endsection
