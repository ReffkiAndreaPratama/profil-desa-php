<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetaRumah extends Model
{
    protected $table = 'peta_rumah';

    protected $fillable = [
        'no_rumah',
        'nama_kk',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'lat',
        'lng',
        'jumlah_jiwa',
        'status_rumah',
        'keterangan',
        'aktif',
    ];

    protected $casts = [
        'lat'         => 'float',
        'lng'         => 'float',
        'jumlah_jiwa' => 'integer',
        'aktif'       => 'boolean',
    ];
}
