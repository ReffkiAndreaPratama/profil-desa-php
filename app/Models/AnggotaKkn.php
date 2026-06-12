<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKkn extends Model
{
    protected $table = 'anggota_kkn';
    protected $fillable = ['nama','prodi','fakultas','posisi','foto','nim'];
}
