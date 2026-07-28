<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\PesanKontak;
use App\Models\Umkm;
use App\Models\Wisata;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita'        => Berita::count(),
            'wisata'        => Wisata::count(),
            'umkm'          => Umkm::count(),
            'galeri'        => Galeri::count(),
            'aspirasi_baru' => Aspirasi::where('status', 'diterima')->count(),
            'pesan_baru'    => PesanKontak::where('sudah_dibaca', false)->count(),
        ];

        $beritaTerbaru   = Berita::orderByDesc('created_at')->take(5)->get();
        $aspirasiTerbaru = Aspirasi::orderByDesc('created_at')->take(5)->get();

        return response()
            ->view('admin.dashboard.index', compact('stats', 'beritaTerbaru', 'aspirasiTerbaru'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}
