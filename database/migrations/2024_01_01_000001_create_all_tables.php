<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users (admin)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Berita
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->date('tanggal');
            $table->string('penulis');
            $table->text('foto')->nullable();
            $table->text('ringkasan');
            $table->longText('konten');
            $table->integer('views')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });

        // Wisata
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->text('foto')->nullable();
            $table->text('deskripsi');
            $table->json('fasilitas')->nullable();
            $table->string('harga')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->text('maps')->nullable();
            $table->decimal('rating', 3, 1)->default(0);
            $table->string('pengunjung')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
        });

        // UMKM
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->text('foto')->nullable();
            $table->text('deskripsi');
            $table->string('harga')->nullable();
            $table->string('kontak')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('stok')->nullable();
            $table->string('lokasi')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
        });

        // Galeri
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->text('foto');
            $table->date('tanggal');
            $table->timestamps();
        });

        // Perangkat Desa
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('nama');
            $table->text('foto')->nullable();
            $table->string('kontak')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Anggota KKN
        Schema::create('anggota_kkn', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('posisi');
            $table->text('foto')->nullable();
            $table->string('nim')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });

        // Program Kerja KKN
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->string('jenis')->default('Program Kerja');
            $table->text('deskripsi');
            $table->text('tujuan')->nullable();
            $table->text('manfaat')->nullable();
            $table->string('status')->default('planned');
            $table->integer('progress')->default(0);
            $table->string('target')->nullable();
            $table->string('output')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('pic')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // Agenda
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->string('jam')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Aspirasi
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->text('pesan');
            $table->string('status')->default('diterima');
            $table->text('balasan')->nullable();
            $table->boolean('anonim')->default(false);
            $table->timestamps();
        });

       
        // Dokumen
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->date('tanggal')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('tipe')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });

        // Pengaturan
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Statistik Desa
        Schema::create('statistik_desa', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('penduduk')->default(0);
            $table->integer('kk')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->integer('perempuan')->default(0);
            $table->integer('umkm')->default(0);
            $table->timestamps();
        });


        // Pesan Kontak
        Schema::create('pesan_kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('subjek')->nullable();
            $table->text('pesan');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $tables = [
            'pesan_kontak','statistik_desa','pengaturan',
            'dokumen','aspirasi',
            'agenda','program_kerja','anggota_kkn','perangkat_desa',
            'galeri','umkm','wisata','berita','users',
        ];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
