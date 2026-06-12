<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikDesa extends Model
{
    protected $table = 'statistik_desa';
    protected $fillable = ['tahun','penduduk','kk','laki_laki','perempuan','umkm'];
    protected $casts = ['tahun' => 'integer'];
}
