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
use App\Models\DataSampah;
use App\Models\Pengaturan;
use App\Models\BankSampahNasabah;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@desatalangmarap.id')],
            [
                'name'     => 'Admin Desa',
                'email'    => env('ADMIN_EMAIL', 'admin@desatalangmarap.id'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
            ]
        );

        // Pengaturan
        $settings = [
            'nama_desa'        => 'Desa Talang Marap',
            'kecamatan'        => 'Kecamatan Kelam Tengah',
            'kabupaten'        => 'Kabupaten Kaur',
            'provinsi'         => 'Provinsi Bengkulu',
            'tagline'          => 'Mengenal Desa, Mengelola Data, Membangun Masa Depan',
            'kepala_desa'      => 'Bapak Sumarno',
            'whatsapp'         => '6281234567890',
            'email'            => 'desatalangmarap@gmail.com',
            'alamat'           => 'Jl. Raya Talang Marap No. 1, Kec. Kelam Tengah, Kab. Kaur',
            'jam_operasional'  => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'instagram'        => 'desatalangmarap',
            'facebook'         => 'Desa Talang Marap',
            'tiktok'           => '@desatalangmarap',
            'youtube'          => 'Portal Desa Talang Marap',
            'jumlah_penduduk'  => '1847',
            'jumlah_kk'        => '512',
            'luas_wilayah'     => '24.5 km²',
            'jumlah_dusun'     => '4',
        ];
        foreach ($settings as $key => $value) {
            Pengaturan::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Berita
        Berita::insert([
            ['judul'=>'Musyawarah Desa Penyusunan RPJMDes 2025-2031','kategori'=>'Pemerintahan','tanggal'=>'2025-06-01','penulis'=>'Admin Desa','foto'=>'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600','ringkasan'=>'Desa Talang Marap menggelar musyawarah desa untuk penyusunan RPJMDes periode 2025-2031.','konten'=>'Musyawarah desa yang dihadiri oleh seluruh perangkat desa, BPD, tokoh masyarakat, dan perwakilan warga ini bertujuan untuk menyusun RPJMDes yang akan menjadi acuan pembangunan desa selama 6 tahun ke depan.','views'=>234,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Tim KKN Periode 108 Kelompok 146 Resmi Bertugas','kategori'=>'KKN','tanggal'=>'2025-06-05','penulis'=>'Tim KKN','foto'=>'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600','ringkasan'=>'Mahasiswa KKN Universitas Bengkulu Periode 108 Kelompok 146 resmi memulai pengabdian mereka di Desa Talang Marap.','konten'=>'Sebanyak 10 mahasiswa dari berbagai fakultas di Universitas Bengkulu siap mengabdi dan berkontribusi dalam pembangunan Desa Talang Marap selama 40 hari ke depan.','views'=>412,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['judul'=>'Launching Program SiTARA - Sistem Informasi Sampah','kategori'=>'Lingkungan','tanggal'=>'2025-06-08','penulis'=>'Tim KKN','foto'=>'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600','ringkasan'=>'Program digitalisasi pengelolaan sampah SiTARA resmi diluncurkan sebagai inovasi KKN untuk desa.','konten'=>'SiTARA hadir sebagai solusi digital pengelolaan sampah yang terintegrasi, mencakup bank sampah digital, jadwal pengangkutan, dan edukasi lingkungan bagi warga.','views'=>389,'published'=>true,'created_at'=>now(),'updated_at'=>now()],
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
            ['jabatan'=>'Kepala Desa','nama'=>'Sumarno','foto'=>'https://ui-avatars.com/api/?name=Sumarno&background=2E7D32&color=fff&size=200','kontak'=>'081234567890','urutan'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Sekretaris Desa','nama'=>'Dewi Lestari','foto'=>'https://ui-avatars.com/api/?name=Dewi+Lestari&background=43A047&color=fff&size=200','kontak'=>'081234567891','urutan'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Bendahara Desa','nama'=>'Andi Kurniawan','foto'=>'https://ui-avatars.com/api/?name=Andi+Kurniawan&background=66BB6A&color=fff&size=200','kontak'=>'081234567892','urutan'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Pemerintahan','nama'=>'Siti Rahayu','foto'=>'https://ui-avatars.com/api/?name=Siti+Rahayu&background=2E7D32&color=fff&size=200','kontak'=>'081234567893','urutan'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Pembangunan','nama'=>'Budi Santoso','foto'=>'https://ui-avatars.com/api/?name=Budi+Santoso&background=43A047&color=fff&size=200','kontak'=>'081234567894','urutan'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Seksi Kemasyarakatan','nama'=>'Rini Wulandari','foto'=>'https://ui-avatars.com/api/?name=Rini+Wulandari&background=81C784&color=fff&size=200','kontak'=>'081234567895','urutan'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Dusun I','nama'=>'Hendra Putra','foto'=>'https://ui-avatars.com/api/?name=Hendra+Putra&background=2E7D32&color=fff&size=200','kontak'=>'081234567896','urutan'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['jabatan'=>'Kepala Dusun II','nama'=>'Yeni Marlina','foto'=>'https://ui-avatars.com/api/?name=Yeni+Marlina&background=43A047&color=fff&size=200','kontak'=>'081234567897','urutan'=>8,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Statistik Desa
        StatistikDesa::insert([
            ['tahun'=>2020,'penduduk'=>1680,'kk'=>467,'laki_laki'=>840,'perempuan'=>840,'umkm'=>18,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2021,'penduduk'=>1710,'kk'=>475,'laki_laki'=>855,'perempuan'=>855,'umkm'=>21,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2022,'penduduk'=>1748,'kk'=>486,'laki_laki'=>874,'perempuan'=>874,'umkm'=>25,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2023,'penduduk'=>1790,'kk'=>498,'laki_laki'=>895,'perempuan'=>895,'umkm'=>28,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2024,'penduduk'=>1820,'kk'=>507,'laki_laki'=>910,'perempuan'=>910,'umkm'=>30,'created_at'=>now(),'updated_at'=>now()],
            ['tahun'=>2025,'penduduk'=>1847,'kk'=>512,'laki_laki'=>921,'perempuan'=>926,'umkm'=>32,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Data Sampah
        DataSampah::insert([
            ['bulan'=>'2025-06','total'=>2840,'organik'=>1704,'anorganik'=>994,'b3'=>142,'created_at'=>now(),'updated_at'=>now()],
            ['bulan'=>'2025-05','total'=>2680,'organik'=>1608,'anorganik'=>938,'b3'=>134,'created_at'=>now(),'updated_at'=>now()],
            ['bulan'=>'2025-04','total'=>2520,'organik'=>1512,'anorganik'=>882,'b3'=>126,'created_at'=>now(),'updated_at'=>now()],
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

        // Dokumen
        Dokumen::insert([
            ['nama'=>'RPJMDes 2020-2025','kategori'=>'Perencanaan','tanggal'=>'2020-01-15','ukuran'=>'2.4 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'APBDes 2025','kategori'=>'Keuangan','tanggal'=>'2025-01-10','ukuran'=>'1.8 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Monografi Desa 2024','kategori'=>'Profil','tanggal'=>'2024-12-31','ukuran'=>'3.2 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Peraturan Desa No.1/2025','kategori'=>'Peraturan','tanggal'=>'2025-03-01','ukuran'=>'0.8 MB','tipe'=>'PDF','url'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Anggota KKN
        AnggotaKkn::insert([
            ['nama'=>'Muhammad Rizky Fauzi','prodi'=>'Teknik Informatika','fakultas'=>'Teknik','posisi'=>'Ketua','foto'=>'https://ui-avatars.com/api/?name=Muhammad+Rizky&background=2E7D32&color=fff&size=200','nim'=>'G1A021001','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Sari Dewi Permata','prodi'=>'Ilmu Hukum','fakultas'=>'Hukum','posisi'=>'Sekretaris','foto'=>'https://ui-avatars.com/api/?name=Sari+Dewi&background=43A047&color=fff&size=200','nim'=>'G1A021002','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Ahmad Faisal Rahman','prodi'=>'Agribisnis','fakultas'=>'Pertanian','posisi'=>'Bendahara','foto'=>'https://ui-avatars.com/api/?name=Ahmad+Faisal&background=66BB6A&color=fff&size=200','nim'=>'G1A021003','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Putri Anggraini','prodi'=>'Kesehatan Masyarakat','fakultas'=>'Kedokteran','posisi'=>'Anggota','foto'=>'https://ui-avatars.com/api/?name=Putri+Anggraini&background=81C784&color=fff&size=200','nim'=>'G1A021004','created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Bima Sakti Pratama','prodi'=>'Ekonomi Pembangunan','fakultas'=>'Ekonomi','posisi'=>'Anggota','foto'=>'https://ui-avatars.com/api/?name=Bima+Sakti&background=2E7D32&color=fff&size=200','nim'=>'G1A021005','created_at'=>now(),'updated_at'=>now()],
        ]);

        // Bank Sampah Nasabah
        BankSampahNasabah::insert([
            ['nama'=>'Bu Sari','nik'=>'1234567890','alamat'=>'Dusun I','no_hp'=>'081111111111','poin'=>2400,'aktif'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Pak Hendra','nik'=>'1234567891','alamat'=>'Dusun II','no_hp'=>'081111111112','poin'=>1950,'aktif'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Bu Dewi','nik'=>'1234567892','alamat'=>'Dusun I','no_hp'=>'081111111113','poin'=>1800,'aktif'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
