<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = [
        'nama','kategori','foto','deskripsi','fasilitas',
        'harga','jam_operasional','maps','rating','pengunjung','published',
    ];
    protected $casts = [
        'fasilitas' => 'array',
        'published' => 'boolean',
        'rating'    => 'float',
    ];
}
