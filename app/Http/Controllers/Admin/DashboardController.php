<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Wisata;
use App\Models\Umkm;
use App\Models\Aspirasi;
use App\Models\LaporanSampah;
use App\Models\BankSampahNasabah;
use App\Models\PesanKontak;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita'          => Berita::count(),
            'wisata'          => Wisata::count(),
            'umkm'            => Umkm::count(),
            'galeri'          => Galeri::count(),
            'aspirasi_baru'   => Aspirasi::where('status', 'diterima')->count(),
            'laporan_baru'    => LaporanSampah::where('status', 'diterima')->count(),
            'nasabah'         => BankSampahNasabah::where('aktif', true)->count(),
            'pesan_baru'      => PesanKontak::where('sudah_dibaca', false)->count(),
        ];

        $beritaTerbaru = Berita::orderByDesc('created_at')->take(5)->get();
        $aspirasiTerbaru = Aspirasi::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'beritaTerbaru', 'aspirasiTerbaru'));
    }
}
