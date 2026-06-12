<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';
    protected $fillable = ['nama','email','telepon','subjek','pesan','sudah_dibaca'];
    protected $casts = ['sudah_dibaca' => 'boolean'];
}
