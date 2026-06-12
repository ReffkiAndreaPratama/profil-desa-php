<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = ['nama','kategori','tanggal','ukuran','tipe','url'];
    protected $casts = ['tanggal' => 'date'];
}
