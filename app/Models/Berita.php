<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul','kategori','tanggal','penulis','foto',
        'ringkasan','konten','views','published',
    ];

    protected $casts = [
        'tanggal'   => 'date',
        'published' => 'boolean',
        'views'     => 'integer',
    ];
}
