<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';
    protected $fillable = ['jabatan','nama','foto','kontak','urutan'];
    protected $casts = ['urutan' => 'integer'];
}
