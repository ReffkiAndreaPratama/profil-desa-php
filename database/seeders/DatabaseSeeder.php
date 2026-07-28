<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Berita;
use App\Models\Wisata;
use App\Models\Umkm;
use App\Models\Galeri;
use App\Models\PerangkatDesa;
use App\Models\AnggotaKkn;
use App\Models\ProgramKerja;
use App\Models\Agenda;
use App\Models\Dokumen;
use App\Models\StatistikDesa;
use App\Models\Pengaturan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => config('auth.admin.email')],
            [
                'name'              => 'Admin Desa',
                'email'             => config('auth.admin.email'),
                'password'          => Hash::make(config('auth.admin.password')),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Pengaturan
        $settings = [
            'nama_desa'        => 'Desa Talang Marap',
            'kecamatan'        => 'Kecamatan Kelam Tengah',
            'kabupaten'        => 'Kabupaten Kaur',
            'provinsi'         => 'Provinsi Bengkulu',
            'tagline'          => 'Mengenal Desa, Mengelola Data, Membangun Masa Depan',
            'kepala_desa'      => 'Midarman',
            'whatsapp'         => '6282350257688',
            'email'            => 'desatalangmarap1@gmail.com',
            'alamat'           => 'Jl. Raya Talang Marap No. 1, Kec. Kelam Tengah, Kab. Kaur',
            'jam_operasional'  => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'instagram'        => 'desatalangmarap',
            'facebook'         => 'Desa Talang Marap',
            'tiktok'           => '@desatalangmarap',
            'youtube'          => 'Smart Village Talang Marap',
            'jumlah_penduduk'  => '648',
            'jumlah_kk'        => '211',
            'luas_wilayah'     => '4610 Ha',
            'jumlah_dusun'     => '2',
            'maps_desa'        => 'https://www.google.com/maps?q=-4.35,103.12',
            'koordinat_desa'   => '-4.35, 103.12',
            'visi'             => 'MENINGKATKAN TATA KELOLA PEMERINTAHAN DESA YANG BAIK DAN BERSIH GUNA MEWUJUDKAN DESA TALANG MARAP YANG ADIL, MAKMUR, SEJAHTERA DAN BERDASARKAN MUSYAWARAH MUFAKAT.',
            'visi_deskripsi'   => 'Visi adalah suatu gambaran yang menantang tentang keadaan masa depan yang diinginkan dengan melihat potensi dan kebutuhan desa. Penyusunan visi Desa Talang Marap ini dilakukan dengan pendekatan partisipatif, melibatkan pihak-pihak yang berkepentingan di Desa Talang Marap seperti Pemerintah Desa, BPD, Tokoh Masyarakat, Tokoh Agama, lembaga masyarakat desa dan masyarakat desa pada umumnya.\n\nPertimbangan kondisi eksternal di desa seperti satuan kerja wilayah pembangunan di Kecamatan Kelam Tengah mempunyai titik berat sektor infrastruktur, maka berdasarkan pertimbangan di atas visi Desa Talang Marap yaitu:',
            'misi'             => "Mewujudkan pemerintah Desa yang tertib, aman, dan transparan\nMewujudkan pembangunan yang merata baik fisik dan pembangunan SDM\nMewujudkan perekonomian dan kesejahteraan masyarakat\nMewujudkan masyarakat yang berakhlak dan religious\nMewujudkan Masyarakat sehat\nMengaktifkan kegiatan kepemudaan\nMewujudkan kegiatan yang jujur, adil dan transparan",
            'misi_deskripsi'   => 'Selain penyusunan visi juga telah ditetapkan misi-misi yang memuat suatu pernyataan yang harus dilaksanakan oleh warga Desa Talang Marap agar tercapainya visi Desa tersebut. Visi berada diatas misi. Pernyataan visi kemudian dijabarkan kedalam misi agar dapat dioperasionalkan/dikerjakan. Sebagaimana penyusunannya menggunakan pendekatan partisipatif dan pertimbangan potensi dan kebutuhan Desa Talang Marap sebagaimana proses yang dilakukan maka misi Desa Talang Marap yaitu:',
            'sejarah'          => json_encode([
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
            'sejarah_narasi'   => "Desa Talang Marap merupakan salah satu Desa dalam Wilayah Administrasi Kecamatan Kelam Tengah yang terletak 3 KM dari sebelah Barat Kecamatan Kelam Tengah yang merupakan Desa hasil pemekaran dengan Desa Pagar Dewa Kecamatan Kelam Tengah Kabupaten Kaur pada tahun 2005.\n\nDiawal zaman penjajah Belanda sementara untuk kedudukan Kepemimpinan Desa atau Dusun dipimpin oleh Depati. Terdiri dari 2 Dusun yaitu Dusun Luuk Bingkok dan Dusun Tanjung Bunga. Pada masa Zaman kepemimpinan Depati Daerah Pagar Dewa masih dalam Zaman peperangan atau gerombolan, setelah selesai masa peperangan kedua Dusun tersebut bergabung menjadi sebuah kelompok dan terbentuk sebuah Desa yang dinamakan Desa Pagar Dewa.\n\nDesa Talang Marap diambil dari keyakinan Masyarakat terhadap dewa, maka dinamakan Talang Marap atau Dewa Pelindung pada tahun 1912. Yang pada masa itu untuk kepemimpinan dipegang oleh Depati Kaemajis, menjabat sebagai Depati dari tahun 1912 sampai dengan 1965.\n\nPada tahun selanjutnya dari tahun 1965 sampai dengan 1972 dipimpin oleh Depati Buyung Alinap, selepas tahun 1972 dengan peraturan baru yang dibuat oleh Pemerintah Republik Indonesia yang mentiadakan Wilayah Pasirah sebagai atasan Depati maka Depati menjadi Kepala Desa saat itu menjabat pertama dari tahun 1972 sampai dengan 1988 dipimpin oleh seorang Kepala Desa yang bernama Idris Ali, dan setelah habis masa jabatan Kepala Desa Talang Marap Idris Ali, digantikan oleh Irsanudin dari tahun 1988 sampai dengan tahun 1999. Pada akhir masa jabatan Irsanudin terjadi kekosongan kepemimpinan karena menunggu proses pemilihan kembali Kepala Desa sehingga kepemimpinan di Desa Talang Marap diambil alih oleh Kecamatan Kaur Utara yang bernama Yaswan.\n\nKemudian dari tahun 2000 sampai dengan Tahun 2006 Desa Pagar Dewa dipimpin oleh Justan, Kepemimpinan Justan hasil dari pemilihan Masyarakat Desa secara langsung. Setelah habis masa jabatan Kepala Desa Pagar Dewa Justan digantikan oleh Disirmin dari Tahun 2007 sampai dengan Tahun 2013. Pada masa pertengahan Kepala Desa Disirmin Tahun 2009 disaat Kabupaten Kaur memisahkan diri dari Kabupaten Bengkulu Selatan banyak pemekaran Kecamatan di Wilayah Kecamatan Kelam Tengah, sehingga terbentuklah Desa Talang Marap.\n\nSetelah terbentuknya Desa Talang Marap maka terpilih pemimpin desa atau Kepala Desa Talang Marap adalah Janusi A. Hamid dari tahun 2016 sampai dengan Tahun 2021 yang terpilih dari pemilihan Kepala Desa Talang Marap secara langsung oleh Masyarakat.\n\nPemimpin Desa atau Kepala Desa Talang Marap adalah Midarman. Dia terpilih dari pemilihan Kepala Desa Talang Marap secara langsung oleh Masyarakat. Midarman menjabat Kepala Desa dari tahun 2022 sampai tahun 2028.",
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
            'pekerjaan'        => json_encode([
                ['label' => 'Petani', 'value' => 320],
                ['label' => 'Pelajar/Mahasiswa', 'value' => 120],
                ['label' => 'Ibu Rumah Tangga', 'value' => 110],
                ['label' => 'Swasta', 'value' => 60],
                ['label' => 'Pedagang', 'value' => 38],
            ]),
        ];
        foreach ($settings as $key => $value) {
            Pengaturan::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Berita
        Berita::insert([
            ['judul'=>'Musyawarah Desa Penyusunan RPJMDes 2025-2031','kategori'=>'Pemerintahan','tanggal'=>'2025-06-01','penulis'=>'Admin Desa','foto'=>'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600','ringkasan'=>'Desa Talang Marap menggelar musyawarah desa untuk penyusunan RPJMDes periode 2025-2031.','konten'=>'Musyawarah desa yang dihadiri oleh seluruh perangkat desa, BPD, tokoh masyarakat, dan perwakilan warga ini bertujuan untuk menyusun RPJMDes yang akan menjadi acuan pembangunan desa selama 6 tahun ke depan.','views'=>234,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Tim KKN Periode 108 Kelompok 146 Resmi Bertugas','kategori'=>'KKN','tanggal'=>'2025-06-05','penulis'=>'Tim KKN','foto'=>'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600','ringkasan'=>'Mahasiswa KKN Universitas Bengkulu Periode 108 Kelompok 146 resmi memulai pengabdian mereka di Desa Talang Marap.','konten'=>'Sebanyak 10 mahasiswa dari berbagai fakultas di Universitas Bengkulu siap mengabdi dan berkontribusi dalam pembangunan Desa Talang Marap selama 40 hari ke depan.','views'=>412,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Festival Panen Raya Desa Talang Marap 2025','kategori'=>'Pertanian','tanggal'=>'2025-05-20','penulis'=>'Admin Desa','foto'=>'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=600','ringkasan'=>'Warga Desa Talang Marap merayakan panen raya dengan festival budaya dan pameran hasil pertanian.','konten'=>'Festival panen raya menjadi momen penting bagi warga untuk bersyukur atas hasil bumi dan mempererat tali silaturahmi antar warga desa.','views'=>521,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Pelatihan Digital Marketing UMKM','kategori'=>'UMKM','tanggal'=>'2025-06-12','penulis'=>'Tim KKN','foto'=>'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600','ringkasan'=>'KKN menggelar pelatihan digital marketing untuk pelaku UMKM agar bisa berjualan secara online.','konten'=>'Pelatihan ini mencakup cara membuat toko online, penggunaan media sosial untuk promosi, fotografi produk, dan cara bergabung di marketplace.','views'=>298,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Wisata
        Wisata::insert([
            ['nama'=>'Air Terjun Talang Indah','kategori'=>'Alam','foto'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600','deskripsi'=>'Air terjun setinggi 25 meter dengan kolam alami yang jernih, dikelilingi hutan tropis yang asri.','fasilitas'=>json_encode(['Parkir','Toilet','Warung Makan','Guide Lokal']),'harga'=>'Rp 10.000/orang','jam_operasional'=>'07.00 - 17.00 WIB','maps'=>'https://maps.google.com','rating'=>4.7,'pengunjung'=>'500+/bulan','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Bukit Panorama Marap','kategori'=>'Alam','foto'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600','deskripsi'=>'Spot terbaik untuk menikmati sunrise dan pemandangan 360° yang memukau di ketinggian 850 mdpl.','fasilitas'=>json_encode(['Camping Area','Spot Foto','Warung','Toilet']),'harga'=>'Rp 15.000/orang','jam_operasional'=>'05.00 - 18.00 WIB','maps'=>'https://maps.google.com','rating'=>4.8,'pengunjung'=>'300+/bulan','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Danau Hijau Talang','kategori'=>'Alam','foto'=>'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600','deskripsi'=>'Danau alami dengan air berwarna hijau tosca yang eksotis, tempat favorit untuk memancing dan piknik.','fasilitas'=>json_encode(['Perahu','Spot Memancing','Area Piknik','Parkir']),'harga'=>'Rp 5.000/orang','jam_operasional'=>'06.00 - 18.00 WIB','maps'=>'https://maps.google.com','rating'=>4.5,'pengunjung'=>'200+/bulan','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Kebun Kopi Heritage','kategori'=>'Agrowisata','foto'=>'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=600','deskripsi'=>'Perkebunan kopi robusta berusia 50 tahun dengan pengalaman petik kopi langsung dan kopi gratis.','fasilitas'=>json_encode(['Edukasi','Cafe','Oleh-oleh','Parkir']),'harga'=>'Rp 20.000/orang','jam_operasional'=>'08.00 - 16.00 WIB','maps'=>'https://maps.google.com','rating'=>4.6,'pengunjung'=>'150+/bulan','published'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // UMKM
        Umkm::insert([
            ['nama'=>'Kopi Robusta Talang Marap','kategori'=>'Minuman','foto'=>'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=400','deskripsi'=>'Kopi robusta premium hasil perkebunan sendiri, tersedia bubuk dan biji.','harga'=>'Rp 45.000 - Rp 120.000','kontak'=>'6281234567880','pemilik'=>'Pak Slamet','stok'=>'Tersedia','lokasi'=>'Dusun I','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Keripik Singkong Manis','kategori'=>'Makanan','foto'=>'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?w=400','deskripsi'=>'Keripik singkong renyah dengan berbagai rasa: original, pedas, keju, BBQ.','harga'=>'Rp 15.000 - Rp 35.000','kontak'=>'6281234567881','pemilik'=>'Bu Ratna','stok'=>'Tersedia','lokasi'=>'Dusun II','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Madu Hutan Asli','kategori'=>'Kesehatan','foto'=>'https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?w=400','deskripsi'=>'Madu hutan murni 100% tanpa campuran dari lebah liar hutan Talang Marap.','harga'=>'Rp 80.000 - Rp 250.000','kontak'=>'6281234567882','pemilik'=>'Pak Darul','stok'=>'Terbatas','lokasi'=>'Dusun III','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Batik Tulis Motif Rafflesia','kategori'=>'Kerajinan','foto'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400','deskripsi'=>'Batik tulis bermotif bunga Rafflesia khas Bengkulu, dibuat oleh pengrajin lokal.','harga'=>'Rp 150.000 - Rp 500.000','kontak'=>'6281234567883','pemilik'=>'Bu Surya','stok'=>'Tersedia','lokasi'=>'Dusun I','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Gula Aren Organik','kategori'=>'Makanan','foto'=>'https://images.unsplash.com/photo-1587143778050-b42bfb726bdf?w=400','deskripsi'=>'Gula aren murni organik tanpa pengawet dari pohon aren lokal desa.','harga'=>'Rp 25.000 - Rp 75.000','kontak'=>'6281234567884','pemilik'=>'Bu Aminah','stok'=>'Tersedia','lokasi'=>'Dusun IV','published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Anyaman Bambu Dekorasi','kategori'=>'Kerajinan','foto'=>'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400','deskripsi'=>'Anyaman bambu artistik untuk dekorasi rumah: vas, keranjang, lampu gantung.','harga'=>'Rp 50.000 - Rp 300.000','kontak'=>'6281234567885','pemilik'=>'Pak Joko','stok'=>'Tersedia','lokasi'=>'Dusun II','published'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Perangkat Desa
        PerangkatDesa::insert([
            ['jabatan'=>'Kepala Desa','nama'=>'Midarman','foto'=>'https://ui-avatars.com/api/?name=Midarman&background=2E7D32&color=fff&size=200','kontak'=>'081234567890','urutan'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Sekretaris Desa','nama'=>'Dewi Lestari','foto'=>'https://ui-avatars.com/api/?name=Dewi+Lestari&background=43A047&color=fff&size=200','kontak'=>'081234567891','urutan'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Bendahara Desa','nama'=>'Andi Kurniawan','foto'=>'https://ui-avatars.com/api/?name=Andi+Kurniawan&background=66BB6A&color=fff&size=200','kontak'=>'081234567892','urutan'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Pemerintahan','nama'=>'Tresia Aprianti','foto'=>'https://ui-avatars.com/api/?name=Tresia+Aprianti&background=2E7D32&color=fff&size=200','kontak'=>'081234567893','urutan'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Pembangunan','nama'=>'Budi Santoso','foto'=>'https://ui-avatars.com/api/?name=Budi+Santoso&background=43A047&color=fff&size=200','kontak'=>'081234567894','urutan'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Kemasyarakatan','nama'=>'Rini Wulandari','foto'=>'https://ui-avatars.com/api/?name=Rini+Wulandari&background=81C784&color=fff&size=200','kontak'=>'081234567895','urutan'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Dusun I','nama'=>'Hendra Putra','foto'=>'https://ui-avatars.com/api/?name=Hendra+Putra&background=2E7D32&color=fff&size=200','kontak'=>'081234567896','urutan'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Dusun II','nama'=>'Yeni Marlina','foto'=>'https://ui-avatars.com/api/?name=Yeni+Marlina&background=43A047&color=fff&size=200','kontak'=>'081234567897','urutan'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Ketua BPD','nama'=>'Hedi Satrio, SH','foto'=>'https://ui-avatars.com/api/?name=Hedi+Satrio&background=2E7D32&color=fff&size=200','kontak'=>'','urutan'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Wakil Ketua BPD','nama'=>'Tetap','foto'=>'https://ui-avatars.com/api/?name=Tetap&background=43A047&color=fff&size=200','kontak'=>'','urutan'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Sekretaris BPD','nama'=>'Kamli','foto'=>'https://ui-avatars.com/api/?name=Kamli&background=66BB6A&color=fff&size=200','kontak'=>'','urutan'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Anggota BPD','nama'=>'Witra Habibi','foto'=>'https://ui-avatars.com/api/?name=Witra+Habibi&background=81C784&color=fff&size=200','kontak'=>'','urutan'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Anggota BPD','nama'=>'Eva Pornamei','foto'=>'https://ui-avatars.com/api/?name=Eva+Pornamei&background=2E7D32&color=fff&size=200','kontak'=>'','urutan'=>13,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Statistik Desa
        StatistikDesa::insert([
            ['tahun'=>2020,'penduduk'=>600,'kk'=>190,'laki_laki'=>300,'perempuan'=>300,'umkm'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2021,'penduduk'=>610,'kk'=>194,'laki_laki'=>305,'perempuan'=>305,'umkm'=>14,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2022,'penduduk'=>620,'kk'=>198,'laki_laki'=>310,'perempuan'=>310,'umkm'=>15,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2023,'penduduk'=>630,'kk'=>202,'laki_laki'=>315,'perempuan'=>315,'umkm'=>17,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2024,'penduduk'=>640,'kk'=>207,'laki_laki'=>320,'perempuan'=>320,'umkm'=>19,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2025,'penduduk'=>648,'kk'=>211,'laki_laki'=>324,'perempuan'=>324,'umkm'=>20,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Galeri
        Galeri::insert([
            ['judul'=>'Musyawarah Desa','kategori'=>'Pemerintahan','foto'=>'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600','tanggal'=>'2025-06-01','created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Kegiatan Posyandu','kategori'=>'Kesehatan','foto'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600','tanggal'=>'2025-06-10','created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Panen Raya','kategori'=>'Pertanian','foto'=>'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=600','tanggal'=>'2025-05-20','created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Air Terjun Talang','kategori'=>'Wisata','foto'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600','tanggal'=>'2025-05-15','created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Produk UMKM','kategori'=>'UMKM','foto'=>'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=600','tanggal'=>'2025-06-12','created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Kegiatan KKN','kategori'=>'KKN','foto'=>'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600','tanggal'=>'2025-06-07','created_at'=>now(),'updated_at'=>now()],
        ]);

        // Agenda
        Agenda::insert([
            ['judul'=>'Posyandu Rutin','tanggal'=>'2025-07-15','jam'=>'08.00 WIB','lokasi'=>'Balai Desa','kategori'=>'Kesehatan','deskripsi'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Musyawarah BPD','tanggal'=>'2025-07-18','jam'=>'10.00 WIB','lokasi'=>'Kantor Desa','kategori'=>'Pemerintahan','deskripsi'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Gotong Royong Desa','tanggal'=>'2025-07-20','jam'=>'07.00 WIB','lokasi'=>'Seluruh Desa','kategori'=>'Sosial','deskripsi'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Lomba 17 Agustus','tanggal'=>'2025-08-17','jam'=>'07.00 WIB','lokasi'=>'Lapangan Desa','kategori'=>'Sosial','deskripsi'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Program Kerja & Kegiatan KKN
        ProgramKerja::insert([
            // Program Kerja
            [
                'nama' => 'Sosialisasi di Sekolah tentang anti bullying',
                'kategori' => 'Pendidikan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Kegiatan edukasi mengenai anti bullying di lingkungan sekolah berupa sosialisasi dan pemasangan poster anti bullying di lingkungan sekolah SDN 20 Kaur.',
                'tujuan' => 'Menanamkan kesadaran pada siswa tentang apa itu bullying dan bentuk-bentuknya. Siswa dapat saling menyayangi dan membiasakan perilaku menghargai sesama teman.',
                'manfaat' => 'Meningkatkan pengetahuan dan kepedulian pada siswa yang lebih mampu mengenali ketika mereka atau temannya menjadi korban, mampu merespon dengan tepat serta menumbuhkan empati untuk saling melindungi.',
                'target' => 'Siswa SDN 20 Kaur',
                'output' => 'Poster dan pemahaman anti bullying',
                'status' => 'ongoing',
                'progress' => 80,
                'icon' => '🏫',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pojok Digital Desa',
                'kategori' => 'Digitalisasi',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan infografis yang didalamnya termuat barcode yang dapat di scan berisi mengenai pengumpulan dan penyusunan data desa yang meliputi profil, berita, wisata, UMKM Desa Talang Marap. Sasaran program ini adalah Pemerintah Desa Talang Marap.',
                'tujuan' => 'Mendokumentasikan informasi desa secara lengkap sebagai sarana informasi, referensi pembangunan serta dapat menjadi pertimbangan dalam pengambilan kebijakan.',
                'manfaat' => 'Tersedianya data desa yang akurat dan terstruktur untuk mendukung perencanaan pembangunan desa.',
                'target' => 'Pemerintah Desa & Masyarakat',
                'output' => 'Infografis & Portal Web Desa',
                'status' => 'ongoing',
                'progress' => 90,
                'icon' => '💻',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pembuatan Palang petunjuk jalan kantor desa',
                'kategori' => 'Pendidikan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan dan pemasangan papan informasi petunjuk jalan menuju kantor desa talang marap. Sasaran program adalah pemerintah desa Talang Marap.',
                'tujuan' => 'Memberikan informasi kepada masyarakat terkait letak kantor desa Talang Marap.',
                'manfaat' => 'Mempermudah masyarakat untuk mengetahui letak kantor desa talang marap.',
                'target' => 'Masyarakat & Pengunjung Desa',
                'output' => 'Papan petunjuk jalan',
                'status' => 'ongoing',
                'progress' => 85,
                'icon' => '📍',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pembuatan Spanduk Pentingnya Mengelola Sampah dengan Benar',
                'kategori' => 'Lingkungan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan spanduk edukatif mengenai pengelolaan sampah yang dipasang di lokasi strategis desa. Sasaran program adalah seluruh masyarakat Desa Talang Marap.',
                'tujuan' => 'Menyampaikan informasi dan mengajak masyarakat untuk menerapkan pengelolaan sampah yang baik dan benar.',
                'manfaat' => 'Meningkatkan kesadaran masyarakat serta memperkuat kampanye peduli lingkungan di desa.',
                'target' => 'Seluruh Masyarakat Desa',
                'output' => 'Spanduk edukasi lingkungan',
                'status' => 'ongoing',
                'progress' => 70,
                'icon' => '♻️',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pembuatan Video Edukasi Cara Memilah Sampah Menjadi Hal yang Bermanfaat',
                'kategori' => 'Lingkungan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan video yang berisi dokumentasi kegiatan KKN, edukasi pengelolaan sampah, dan pesan-pesan lingkungan. Sasaran program adalah masyarakat Desa Talang Marap dan masyarakat luas melalui media sosial.',
                'tujuan' => 'Menyebarluaskan informasi mengenai pengelolaan sampah dan mendokumentasikan kegiatan KKN secara kreatif.',
                'manfaat' => 'Menjadi media pembelajaran yang mudah diakses, menarik, dan dapat menjangkau audiens yang lebih luas.',
                'target' => 'Masyarakat Desa & Publik',
                'output' => 'Video edukasi sosial media',
                'status' => 'ongoing',
                'progress' => 60,
                'icon' => '🎥',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pembuatan Gapura Desa minim anggaran',
                'kategori' => 'Lingkungan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan gapura desa. Sasaran program adalah masyarakat dan karang taruna Desa Talang Marap.',
                'tujuan' => 'Adanya gapura desa talang marap sebagai penanda perbatasan dengan desa lain dan telah masuk wilayah desa talang marap.',
                'manfaat' => 'Untuk mengetahui batas wilayah desa.',
                'target' => 'Masyarakat & Karang Taruna',
                'output' => 'Gapura batas wilayah',
                'status' => 'ongoing',
                'progress' => 50,
                'icon' => '🚧',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Inovasi Kreatif Penebaran Pupuk Pertanian berbahan pipa',
                'kategori' => 'Pertanian',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan inovasi media penebaran pupuk pertanian menggunakan pipa untuk memudahkan petani saat menebarkan pupuk pada tanaman pertanian.',
                'tujuan' => 'Memudahkan petani dalam penebaran pupuk pertanian agar lebih efisien.',
                'manfaat' => 'Penebaran pupuk menjadi lebih efisien and dapat digunakan dalam jangka panjang.',
                'target' => 'Petani Desa Talang Marap',
                'output' => 'Alat penebar pupuk pipa',
                'status' => 'planned',
                'progress' => 0,
                'icon' => '🌾',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rocket Stove dan Bank Sampah',
                'kategori' => 'Lingkungan',
                'jenis' => 'Program Kerja',
                'deskripsi' => 'Pembuatan tempat pembakaran sampah minim asap.',
                'tujuan' => 'Pengelolaan tempat pembuangan akhir sampah agar tidak menumpuk dan mencemari lingkungan.',
                'manfaat' => 'Sampah tidak menumpuk dan pencemaran air akibat sampah dapat berkurang.',
                'target' => 'Masyarakat Desa',
                'output' => 'Tungku pembakaran minim asap',
                'status' => 'planned',
                'progress' => 0,
                'icon' => '🪵',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Kegiatan
            [
                'nama' => 'Gotong Royong',
                'kategori' => 'Lingkungan',
                'jenis' => 'Kegiatan',
                'deskripsi' => 'Kegiatan kerja bakti bersama masyarakat untuk membersihkan lingkungan Desa Talang Marap. Sasaran program adalah seluruh warga desa, perangkat desa, dan mahasiswa KKN.',
                'tujuan' => 'Meningkatkan kebersihan lingkungan serta memperkuat semangat kebersamaan dan gotong royong masyarakat.',
                'manfaat' => 'Lingkungan menjadi lebih bersih, sehat, dan nyaman serta mempererat hubungan sosial antarwarga.',
                'target' => 'Lingkungan Desa & Warga',
                'output' => 'Kebersihan & kebersamaan desa',
                'status' => 'ongoing',
                'progress' => 40,
                'icon' => '🤝',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Senam Sehat Bersama Masyarakat',
                'kategori' => 'Kesehatan',
                'jenis' => 'Kegiatan',
                'deskripsi' => 'Kegiatan olahraga bersama yang melibatkan masyarakat dan mahasiswa KKN. Sasaran program adalah seluruh warga Desa Talang Marap.',
                'tujuan' => 'Meningkatkan kesehatan fisik masyarakat dan mempererat hubungan sosial antara mahasiswa KKN dan warga.',
                'manfaat' => 'Masyarakat menjadi lebih sehat, aktif, dan terjalin hubungan yang harmonis antarwarga serta mahasiswa KKN.',
                'target' => 'Seluruh Warga Desa',
                'output' => 'Kebugaran & keakraban warga',
                'status' => 'ongoing',
                'progress' => 50,
                'icon' => '🏃‍♂️',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Dokumen
        Dokumen::insert([
            ['nama'=>'RPJMDes 2020-2025','kategori'=>'Perencanaan','tanggal'=>'2020-01-15','ukuran'=>'2.4 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'APBDes 2025','kategori'=>'Keuangan','tanggal'=>'2025-01-10','ukuran'=>'1.8 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Monografi Desa 2024','kategori'=>'Profil','tanggal'=>'2024-12-31','ukuran'=>'3.2 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Peraturan Desa No.1/2025','kategori'=>'Peraturan','tanggal'=>'2025-03-01','ukuran'=>'0.8 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Anggota KKN
        AnggotaKkn::insert([
            ['nama'=>'Muhammad Rizky Fauzi','prodi'=>'Teknik Informatika','fakultas'=>'Teknik','posisi'=>'Ketua','foto'=>'https://ui-avatars.com/api/?name=Muhammad+Rizky&background=2E7D32&color=fff&size=200','nim'=>'G1A021001','instagram'=>'rizky_fauzi','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Sari Dewi Permata','prodi'=>'Ilmu Hukum','fakultas'=>'Hukum','posisi'=>'Sekretaris','foto'=>'https://ui-avatars.com/api/?name=Sari+Dewi&background=43A047&color=fff&size=200','nim'=>'G1A021002','instagram'=>'saridewi.p','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Ahmad Faisal Rahman','prodi'=>'Agribisnis','fakultas'=>'Pertanian','posisi'=>'Bendahara','foto'=>'https://ui-avatars.com/api/?name=Ahmad+Faisal&background=66BB6A&color=fff&size=200','nim'=>'G1A021003','instagram'=>'ahmad_faisal','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Putri Anggraini','prodi'=>'Kesehatan Masyarakat','fakultas'=>'Kedokteran','posisi'=>'Bidang Kesehatan','foto'=>'https://ui-avatars.com/api/?name=Putri+Anggraini&background=81C784&color=fff&size=200','nim'=>'G1A021004','instagram'=>'putri_anggrn','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Bima Sakti Pratama','prodi'=>'Ekonomi Pembangunan','fakultas'=>'Ekonomi','posisi'=>'Bidang Ekonomi','foto'=>'https://ui-avatars.com/api/?name=Bima+Sakti&background=2E7D32&color=fff&size=200','nim'=>'G1A021005','instagram'=>'bima_sakti','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Rina Marlina','prodi'=>'Ilmu Komunikasi','fakultas'=>'FISIP','posisi'=>'Humas','foto'=>'https://ui-avatars.com/api/?name=Rina+Marlina&background=43A047&color=fff&size=200','nim'=>'G1A021006','instagram'=>'rina_marln','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Doni Setiawan','prodi'=>'Teknik Sipil','fakultas'=>'Teknik','posisi'=>'Perlengkapan','foto'=>'https://ui-avatars.com/api/?name=Doni+Setiawan&background=66BB6A&color=fff&size=200','nim'=>'G1A021007','instagram'=>'doni_setiawan','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Yesi Rahayu','prodi'=>'Pendidikan Biologi','fakultas'=>'FKIP','posisi'=>'Bidang Pendidikan','foto'=>'https://ui-avatars.com/api/?name=Yesi+Rahayu&background=81C784&color=fff&size=200','nim'=>'G1A021008','instagram'=>'yesi_rhy','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Fajar Nugroho','prodi'=>'Manajemen','fakultas'=>'Ekonomi','posisi'=>'Acara','foto'=>'https://ui-avatars.com/api/?name=Fajar+Nugroho&background=2E7D32&color=fff&size=200','nim'=>'G1A021009','instagram'=>'fajar_nugroho','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Layla Safitri','prodi'=>'Ilmu Gizi','fakultas'=>'Kedokteran','posisi'=>'Konsumsi','foto'=>'https://ui-avatars.com/api/?name=Layla+Safitri&background=43A047&color=fff&size=200','nim'=>'G1A021010','instagram'=>'layla_sftr','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
