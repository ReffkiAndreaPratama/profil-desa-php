<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $fillable = ['judul','tanggal','jam','lokasi','kategori','deskripsi'];
    protected $casts = ['tanggal' => 'date'];
}
