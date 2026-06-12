<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankSampahNasabah extends Model
{
    protected $table = 'bank_sampah_nasabah';
    protected $fillable = ['nama','nik','alamat','no_hp','poin','aktif'];
    protected $casts = ['aktif' => 'boolean', 'poin' => 'integer'];
}
