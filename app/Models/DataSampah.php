<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSampah extends Model
{
    protected $table = 'data_sampah';
    protected $fillable = ['bulan','total','organik','anorganik','b3'];
    protected $casts = ['total' => 'integer', 'organik' => 'integer', 'anorganik' => 'integer', 'b3' => 'integer'];
}
