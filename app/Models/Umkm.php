<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $fillable = [
        'nama','kategori','foto','deskripsi','harga',
        'kontak','pemilik','stok','lokasi','published',
    ];
    protected $casts = ['published' => 'boolean'];
}
