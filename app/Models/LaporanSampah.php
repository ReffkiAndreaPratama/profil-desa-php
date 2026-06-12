<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampah';
    protected $fillable = ['nama','lokasi','deskripsi','foto','status','catatan_admin'];
}
