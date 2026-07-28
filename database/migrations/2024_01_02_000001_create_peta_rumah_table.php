<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peta_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('no_rumah');           // Nomor rumah / kode
            $table->string('nama_kk');            // Nama Kepala Keluarga
            $table->string('alamat')->nullable();  // Alamat lengkap
            $table->string('rt')->nullable();      // RT
            $table->string('rw')->nullable();      // RW
            $table->string('dusun')->nullable();   // Dusun
            $table->decimal('lat', 10, 7);         // Latitude
            $table->decimal('lng', 10, 7);         // Longitude
            $table->integer('jumlah_jiwa')->default(1); // Jumlah jiwa dalam rumah
            $table->string('status_rumah')->default('tetap'); // tetap, kontrak, dll
            $table->text('keterangan')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peta_rumah');
    }
};
