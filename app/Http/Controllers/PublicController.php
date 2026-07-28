<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Wisata;
use App\Models\Umkm;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\AnggotaKkn;
use App\Models\ProgramKerja;
use App\Models\Pengaturan;
use App\Models\PetaRumah;
use App\Models\StatistikDesa;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private function getDesaInfo(): array
    {
        $settings = Pengaturan::pluck('value', 'key')->toArray();

        // Default fallbacks — keys match the `pengaturan` table keys
        $defaults = [
            'nama_desa'       => 'Desa Talang Marap',
            'kecamatan'       => 'Kecamatan Kelam Tengah',
            'kabupaten'       => 'Kabupaten Kaur',
            'provinsi'        => 'Provinsi Bengkulu',
            'tagline'         => 'Mengenal Desa, Mengelola Data, Membangun Masa Depan',
            'kepala_desa'     => 'Midarman',
            'whatsapp'        => '6282350257688',
            'email'           => 'desatalangmarap1@gmail.com',
            'alamat'          => 'Jl. Raya Talang Marap No. 1, Kec. Kelam Tengah, Kab. Kaur',
            'jam_operasional' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'instagram'       => 'desatalangmarap',
            'facebook'        => 'Desa Talang Marap',
            'jumlah_penduduk' => '648',
            'jumlah_kk'       => '211',
            'luas_wilayah'    => '4610 Ha',
            'jumlah_dusun'    => '2',
            'maps_desa'       => 'https://www.google.com/maps?q=-4.57306,103.20694',
            'koordinat_desa'  => '-4.57306, 103.20694',
            'visi'            => 'MENINGKATKAN TATA KELOLA PEMERINTAHAN DESA YANG BAIK DAN BERSIH GUNA MEWUJUDKAN DESA TALANG MARAP YANG ADIL, MAKMUR, SEJAHTERA DAN BERDASARKAN MUSYAWARAH MUFAKAT.',
            'visi_deskripsi'  => 'Visi adalah suatu gambaran yang menantang tentang keadaan masa depan yang diinginkan dengan melihat potensi dan kebutuhan desa. Penyusunan visi Desa Talang Marap ini dilakukan dengan pendekatan partisipatif, melibatkan pihak-pihak yang berkepentingan di Desa Talang Marap seperti Pemerintah Desa, BPD, Tokoh Masyarakat, Tokoh Agama, lembaga masyarakat desa dan masyarakat desa pada umumnya.\n\nPertimbangan kondisi eksternal di desa seperti satuan kerja wilayah pembangunan di Kecamatan Kelam Tengah mempunyai titik berat sektor infrastruktur, maka berdasarkan pertimbangan di atas visi Desa Talang Marap yaitu:',
            'misi'            => "Mewujudkan pemerintah Desa yang tertib, aman, dan transparan\nMewujudkan pembangunan yang merata baik fisik dan pembangunan SDM\nMewujudkan perekonomian dan kesejahteraan masyarakat\nMewujudkan masyarakat yang berakhlak dan religious\nMewujudkan Masyarakat sehat\nMengaktifkan kegiatan kepemudaan\nMewujudkan kegiatan yang jujur, adil dan transparan",
            'misi_deskripsi'  => 'Selain penyusunan visi juga telah ditetapkan misi-misi yang memuat suatu pernyataan yang harus dilaksanakan oleh warga Desa Talang Marap agar tercapainya visi Desa tersebut. Visi berada diatas misi. Pernyataan visi kemudian dijabarkan kedalam misi agar dapat dioperasionalkan/dikerjakan. Sebagaimana penyusunannya menggunakan pendekatan partisipatif dan pertimbangan potensi dan kebutuhan Desa Talang Marap sebagaimana proses yang dilakukan maka misi Desa Talang Marap yaitu:',
            'sejarah'         => json_encode([
                ['tahun' => '1912', 'judul' => 'Zaman Depati Kaemajis', 'desc' => 'Talang Marap diambil dari keyakinan masyarakat terhadap Dewa Pelindung pada tahun 1912. Kepemimpinan dipegang oleh Depati Kaemajis (1912-1965).'],
                ['tahun' => '1965', 'judul' => 'Zaman Depati Buyung Alinap', 'desc' => 'Masa kepemimpinan dilanjutkan oleh Depati Buyung Alinap (1965-1972).'],
                ['tahun' => '1972', 'judul' => 'Sistem Kepala Desa Pertama', 'desc' => 'Ditiadakannya wilayah Pasirah oleh Pemerintah RI. Jabatan Depati diubah menjadi Kepala Desa, dijabat pertama oleh Idris Ali (1972-1988).'],
                ['tahun' => '1988', 'judul' => 'Masa Jabatan Irsanudin', 'desc' => 'Kepala Desa Irsanudin menjabat dari 1988 hingga 1999. Sempat diisi oleh Pjs. Yaswan dari Kecamatan Kaur Utara karena kekosongan.'],
                ['tahun' => '2000', 'judul' => 'Kepemimpinan Justan', 'desc' => 'Justan memimpin desa hasil pemilihan langsung masyarakat (2000-2006).'],
                ['tahun' => '2005', 'judul' => 'Pemekaran Desa', 'desc' => 'Pemekaran Desa Talang Marap dengan Desa Pagar Dewa, Kecamatan Kelam Tengah.'],
                ['tahun' => '2007', 'judul' => 'Kepemimpinan Disirmin', 'desc' => 'Disirmin menjabat dari 2007 hingga 2013.'],
                ['tahun' => '2009', 'judul' => 'Pemekaran Kecamatan', 'desc' => 'Kabupaten Kaur memisahkan diri dari Bengkulu Selatan, memicu pemekaran Kecamatan Kelam Tengah, sehingga secara definitif terbentuk Desa Talang Marap.'],
                ['tahun' => '2016', 'judul' => 'Kepemimpinan Janusi A. Hamid', 'desc' => 'Janusi A. Hamid terpilih secara langsung oleh masyarakat sebagai Kepala Desa periode 2016-2021.'],
                ['tahun' => '2022', 'judul' => 'Kepemimpinan Midarman', 'desc' => 'Midarman menjabat sebagai Kepala Desa terpilih secara langsung untuk masa jabatan 2022 sampai dengan 2028.'],
            ]),
            'sejarah_narasi'  => "Desa Talang Marap merupakan salah satu Desa dalam Wilayah Administrasi Kecamatan Kelam Tengah yang terletak 3 KM dari sebelah Barat Kecamatan Kelam Tengah yang merupakan Desa hasil pemekaran dengan Desa Pagar Dewa Kecamatan Kelam Tengah Kabupaten Kaur pada tahun 2005.\n\nDiawal zaman penjajah Belanda sementara untuk kedudukan Kepemimpinan Desa atau Dusun dipimpin oleh Depati. Terdiri dari 2 Dusun yaitu Dusun Luuk Bingkok dan Dusun Tanjung Bunga. Pada masa Zaman kepemimpinan Depati Daerah Pagar Dewa masih dalam Zaman peperangan atau gerombolan, setelah selesai masa peperangan kedua Dusun tersebut bergabung menjadi sebuah kelompok dan terbentuk sebuah Desa yang dinamakan Desa Pagar Dewa.\n\nDesa Talang Marap diambil dari keyakinan Masyarakat terhadap dewa, maka dinamakan Talang Marap atau Dewa Pelindung pada tahun 1912. Yang pada masa itu untuk kepemimpinan dipegang oleh Depati Kaemajis, menjabat sebagai Depati dari tahun 1912 sampai dengan 1965.\n\nPada tahun selanjutnya dari tahun 1965 sampai dengan 1972 dipimpin oleh Depati Buyung Alinap, selepas tahun 1972 dengan peraturan baru yang dibuat oleh Pemerintah Republik Indonesia yang mentiadakan Wilayah Pasirah sebagai atasan Depati maka Depati menjadi Kepala Desa saat itu menjabat pertama dari tahun 1972 sampai dengan 1988 dipimpin oleh seorang Kepala Desa yang bernama Idris Ali, dan setelah habis masa jabatan Kepala Desa Talang Marap Idris Ali, digantikan oleh Irsanudin dari tahun 1988 sampai dengan tahun 1999. Pada akhir masa jabatan Irsanudin terjadi kekosongan kepemimpinan karena menunggu proses pemilihan kembali Kepala Desa sehingga kepemimpinan di Desa Talang Marap diambil alih oleh Kecamatan Kaur Utara yang bernama Yaswan.\n\nKemudian dari tahun 2000 sampai dengan Tahun 2006 Desa Pagar Dewa dipimpin oleh Justan, Kepemimpinan Justan hasil dari pemilihan Masyarakat Desa secara langsung. Setelah habis masa jabatan Kepala Desa Pagar Dewa Justan digantikan oleh Disirmin dari Tahun 2007 sampai dengan Tahun 2013. Pada masa pertengahan Kepala Desa Disirmin Tahun 2009 disaat Kabupaten Kaur memisahkan diri dari Kabupaten Bengkulu Selatan banyak pemekaran Kecamatan di Wilayah Kecamatan Kelam Tengah, sehingga terbentuklah Desa Talang Marap.\n\nSetelah terbentuknya Desa Talang Marap maka terpilih pemimpin desa atau Kepala Desa Talang Marap adalah Janusi A. Hamid dari tahun 2016 sampai dengan Tahun 2021 yang terpilih dari pemilihan Kepala Desa Talang Marap secara langsung oleh Masyarakat.\n\nPemimpin Desa atau Kepala Desa Talang Marap adalah Midarman. Dia terpilih dari pemilihan Kepala Desa Talang Marap secara langsung oleh Masyarakat. Midarman menjabat Kepala Desa dari tahun 2022 sampai tahun 2028.",
            'geografi_batas_utara'   => 'Desa Talang Tais',
            'geografi_batas_selatan' => 'Desa Pagar Dewa',
            'geografi_batas_barat'   => 'Desa Curup Air Putih',
            'geografi_batas_timur'   => 'Seranjangan Besar',
            'geografi_topografi'     => 'Secara umum keadaan Topografi Desa Talang Marap adalah merupakan daerah dataran rendah bergelombang.',
            'geografi_iklim'         => 'Iklim Desa Talang Marap sebagaimana desa-desa lain di wilayah Indonesia mempunyai iklim kemarau dan penghujan. Hal ini mempunyai pengaruh langsung terhadap pola tanam yang ada di Desa Talang Marap Kecamatan Kelam Tengah Kabupaten Kaur.',
            'geografi_luas_total'       => '6000',
            'geografi_luas_pemukiman'   => '1000',
            'geografi_luas_persawahan'  => '60',
            'geografi_luas_perkebunan'  => '1300',
            'geografi_luas_ladang'      => '1250',
            'geografi_luas_lainnya'     => '1000',
            'geografi_keluarga_miskin'  => '86',
            'pekerjaan'       => json_encode([
                ['label' => 'Petani', 'value' => 320],
                ['label' => 'Pelajar/Mahasiswa', 'value' => 120],
                ['label' => 'Ibu Rumah Tangga', 'value' => 110],
                ['label' => 'Swasta', 'value' => 60],
                ['label' => 'Pedagang', 'value' => 38],
            ]),
        ];

        return array_merge($defaults, $settings);
    }

    private function formatCompactNumber(int $value): string
    {
        if ($value >= 1000) {
            return rtrim(rtrim(number_format($value / 1000, 1, '.', ''), '0'), '.') . 'K+';
        }

        return $value . '+';
    }

    private function parsePriceValue(?string $harga): ?int
    {
        if (empty($harga)) {
            return null;
        }

        $clean = preg_replace('/[^0-9]/', '', $harga);

        return $clean !== '' ? (int) $clean : null;
    }

    private function buildWisataStats($wisata): array
    {
        $count = $wisata->count();
        $avgRating = $count > 0 ? round((float) $wisata->avg('rating'), 1) : 0;

        $visitorTotal = 0;
        $minPrice = null;

        foreach ($wisata as $item) {
            preg_match('/(\d+)/', (string) ($item->pengunjung ?? ''), $matches);
            if (!empty($matches[1])) {
                $visitorTotal += (int) $matches[1];
            }

            $price = $this->parsePriceValue($item->harga);
            if ($price !== null && ($minPrice === null || $price < $minPrice)) {
                $minPrice = $price;
            }
        }

        return [
            ['icon' => '🏞️', 'label' => 'Destinasi',     'value' => (string) $count],
            ['icon' => '⭐',  'label' => 'Rating',        'value' => number_format($avgRating, 1, '.', '')],
            ['icon' => '👥',  'label' => 'Pengunjung/Bln','value' => $this->formatCompactNumber($visitorTotal)],
            ['icon' => '💰',  'label' => 'Mulai',         'value' => $minPrice !== null ? 'Rp ' . number_format($minPrice, 0, ',', '.') : 'Rp 0'],
        ];
    }

    public function home()
    {
        $desa      = $this->getDesaInfo();
        $berita    = Berita::where('published', true)->orderByDesc('tanggal')->take(3)->get();
        $agenda    = Agenda::where('tanggal', '>=', now()->toDateString())->orderBy('tanggal')->take(4)->get();
        $statistik = StatistikDesa::orderByDesc('tahun')->first();
        $wisata    = Wisata::where('published', true)->get();
        $tickerNews = Berita::where('published', true)->orderByDesc('tanggal')->take(5)->get();

        $homeStats = [
            ['label' => 'Total Penduduk', 'value' => $desa['jumlah_penduduk'] ?? ($statistik?->penduduk ?? '1847'), 'icon' => '👥', 'trend' => '+2.3%'],
            ['label' => 'Kepala Keluarga', 'value' => $desa['jumlah_kk'] ?? ($statistik?->kk ?? '512'), 'icon' => '🏠', 'trend' => '+1.8%'],
            ['label' => 'UMKM Aktif', 'value' => Umkm::where('published', true)->count(), 'icon' => '🛍️', 'trend' => '+5.1%'],
            ['label' => 'Wisatawan/Bulan', 'value' => $this->formatCompactNumber($wisata->sum(function ($item) { preg_match('/(\d+)/', (string) ($item->pengunjung ?? ''), $matches); return !empty($matches[1]) ? (int) $matches[1] : 0; })), 'icon' => '🏞️', 'trend' => '+12%'],
        ];

        return view('public.home', compact('desa', 'berita', 'agenda', 'statistik', 'wisata', 'homeStats', 'tickerNews'));
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
        $desa      = $this->getDesaInfo();
        $wisata    = Wisata::where('published', true)->get();
        $wisataStats = $this->buildWisataStats($wisata);

        return view('public.wisata', compact('desa', 'wisata', 'wisataStats'));
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

    public function data()
    {
        $desa      = $this->getDesaInfo();
        $statistik = StatistikDesa::orderBy('tahun')->get();
        return view('public.data', compact('desa', 'statistik'));
    }

    public function peta()
    {
        $desa = $this->getDesaInfo();
        return view('public.peta', compact('desa'));
    }

    public function petaRumahGeojson()
    {
        $rumah = PetaRumah::where('aktif', true)->get();

        $features = $rumah->map(function ($r) {
            return [
                'type'     => 'Feature',
                'geometry' => [
                    'type'        => 'Point',
                    'coordinates' => [$r->lng, $r->lat],
                ],
                'properties' => [
                    'id'           => $r->id,
                    'no_rumah'     => $r->no_rumah,
                    'nama_kk'      => $r->nama_kk,
                    'alamat'       => $r->alamat,
                    'rt'           => $r->rt,
                    'rw'           => $r->rw,
                    'dusun'        => $r->dusun,
                    'jumlah_jiwa'  => $r->jumlah_jiwa,
                    'status_rumah' => $r->status_rumah,
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    public function kalender()
    {
        $desa   = $this->getDesaInfo();
        $agenda = Agenda::orderBy('tanggal')->get();
        return view('public.kalender', compact('desa', 'agenda'));
    }

    public function kkn()
    {
        $desa    = $this->getDesaInfo();
        $anggota = AnggotaKkn::orderBy('id')->get();
        $proker  = ProgramKerja::orderBy('id')->get();
        return view('public.kkn', compact('desa', 'anggota', 'proker'));
    }

}
