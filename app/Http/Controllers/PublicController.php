<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Wisata;
use App\Models\Umkm;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\Dokumen;
use App\Models\AnggotaKkn;
use App\Models\ProgramKerja;
use App\Models\BankSampahNasabah;
use App\Models\LaporanSampah;
use App\Models\Pengaturan;
use App\Models\StatistikDesa;
use App\Models\DataSampah;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private function getDesaInfo(): array
    {
        $settings = Pengaturan::pluck('value', 'key')->toArray();
        return array_merge([
            'nama'           => 'Desa Talang Marap',
            'kecamatan'      => 'Kecamatan Kelam Tengah',
            'kabupaten'      => 'Kabupaten Kaur',
            'provinsi'       => 'Provinsi Bengkulu',
            'tagline'        => 'Mengenal Desa, Mengelola Data, Membangun Masa Depan',
            'kepala'         => 'Bapak Sumarno',
            'whatsapp'       => '6281234567890',
            'email'          => 'desatalangmarap@gmail.com',
            'alamat'         => 'Jl. Raya Talang Marap No. 1, Kec. Kelam Tengah, Kab. Kaur',
            'jam_operasional'=> 'Senin - Jumat: 08.00 - 16.00 WIB',
            'instagram'      => 'desatalangmarap',
            'facebook'       => 'Desa Talang Marap',
        ], $settings);
    }

    public function home()
    {
        $desa    = $this->getDesaInfo();
        $berita  = Berita::where('published', true)->orderByDesc('tanggal')->take(3)->get();
        $wisata  = Wisata::where('published', true)->take(4)->get();
        $agenda  = Agenda::orderBy('tanggal')->where('tanggal', '>=', now()->toDateString())->take(4)->get();
        $sampah  = DataSampah::orderByDesc('bulan')->first();
        $statistik = StatistikDesa::orderByDesc('tahun')->first();
        return view('public.home', compact('desa', 'berita', 'wisata', 'agenda', 'sampah', 'statistik'));
    }

    public function profil()
    {
        $desa      = $this->getDesaInfo();
        $perangkat = \App\Models\PerangkatDesa::orderBy('urutan')->get();
        $statistik = StatistikDesa::orderByDesc('tahun')->first();
        return view('public.profil', compact('desa', 'perangkat', 'statistik'));
    }

    public function berita(Request $request)
    {
        $desa  = $this->getDesaInfo();
        $query = Berita::where('published', true)->orderByDesc('tanggal');
        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }
        $berita = $query->paginate(9)->withQueryString();
        return view('public.berita', compact('desa', 'berita'));
    }

    public function beritaDetail($id)
    {
        $desa   = $this->getDesaInfo();
        $berita = Berita::where('published', true)->findOrFail($id);
        $berita->increment('views');
        $related = Berita::where('published', true)
            ->where('kategori', $berita->kategori)
            ->where('id', '!=', $id)
            ->take(3)->get();
        return view('public.berita-detail', compact('desa', 'berita', 'related'));
    }

    public function wisata()
    {
        $desa   = $this->getDesaInfo();
        $wisata = Wisata::where('published', true)->get();
        return view('public.wisata', compact('desa', 'wisata'));
    }

    public function umkm(Request $request)
    {
        $desa  = $this->getDesaInfo();
        $query = Umkm::where('published', true);
        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        if ($request->search) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }
        $umkm = $query->paginate(12)->withQueryString();
        return view('public.umkm', compact('desa', 'umkm'));
    }

    public function galeri(Request $request)
    {
        $desa  = $this->getDesaInfo();
        $query = Galeri::orderByDesc('tanggal');
        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        $galeri = $query->paginate(12)->withQueryString();
        return view('public.galeri', compact('desa', 'galeri'));
    }

    public function kontak()
    {
        $desa = $this->getDesaInfo();
        return view('public.kontak', compact('desa'));
    }

    public function kontakSubmit(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string|max:1000',
        ]);
        PesanKontak::create([
            'nama'        => $request->nama,
            'email'       => $request->email,
            'telepon'     => $request->telepon,
            'subjek'      => $request->subjek,
            'pesan'       => $request->pesan,
            'sudah_dibaca'=> false,
        ]);
        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera merespons.');
    }

    public function aspirasi()
    {
        $desa = $this->getDesaInfo();
        return view('public.aspirasi', compact('desa'));
    }

    public function aspirasiSubmit(Request $request)
    {
        $request->validate([
            'nama'     => 'required_if:anonim,false|nullable|string|max:100',
            'kategori' => 'required|string',
            'pesan'    => 'required|string|max:2000',
        ]);
        Aspirasi::create([
            'nama'     => $request->anonim ? 'Anonim' : $request->nama,
            'kategori' => $request->kategori,
            'pesan'    => $request->pesan,
            'status'   => 'diterima',
            'balasan'  => null,
            'anonim'   => (bool)$request->anonim,
        ]);
        return back()->with('success', 'Aspirasi berhasil dikirim! Terima kasih atas partisipasi Anda.');
    }

    public function dokumen(Request $request)
    {
        $desa  = $this->getDesaInfo();
        $query = Dokumen::orderByDesc('tanggal');
        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        if ($request->search) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }
        $dokumen = $query->get();
        return view('public.dokumen', compact('desa', 'dokumen'));
    }

    public function data()
    {
        $desa      = $this->getDesaInfo();
        $statistik = StatistikDesa::orderBy('tahun')->get();
        $sampah    = DataSampah::orderByDesc('bulan')->take(6)->get();
        return view('public.data', compact('desa', 'statistik', 'sampah'));
    }

    public function peta()
    {
        $desa = $this->getDesaInfo();
        return view('public.peta', compact('desa'));
    }

    public function kalender()
    {
        $desa   = $this->getDesaInfo();
        $agenda = Agenda::orderBy('tanggal')->get();
        return view('public.kalender', compact('desa', 'agenda'));
    }

    public function sitara()
    {
        $desa      = $this->getDesaInfo();
        $nasabah   = BankSampahNasabah::where('aktif', true)->orderByDesc('poin')->take(10)->get();
        $sampah    = DataSampah::orderByDesc('bulan')->first();
        $laporan   = LaporanSampah::orderByDesc('created_at')->take(5)->get();
        return view('public.sitara', compact('desa', 'nasabah', 'sampah', 'laporan'));
    }

    public function kkn()
    {
        $desa    = $this->getDesaInfo();
        $anggota = AnggotaKkn::orderBy('id')->get();
        $proker  = ProgramKerja::orderBy('id')->get();
        return view('public.kkn', compact('desa', 'anggota', 'proker'));
    }

    public function laporanSampahSubmit(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ]);
        LaporanSampah::create([
            'nama'          => $request->nama,
            'lokasi'        => $request->lokasi,
            'deskripsi'     => $request->deskripsi,
            'foto'          => null,
            'status'        => 'diterima',
            'catatan_admin' => null,
        ]);
        return back()->with('success', 'Laporan sampah berhasil dikirim!');
    }
}
