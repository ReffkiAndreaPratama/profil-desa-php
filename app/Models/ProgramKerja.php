<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    protected $table = 'program_kerja';
    protected $fillable = [
        'nama','kategori','deskripsi','status','progress',
        'target','output','tanggal_mulai','tanggal_selesai','pic','icon',
    ];
    protected $casts = [
        'progress'      => 'integer',
        'tanggal_mulai' => 'date',
        'tanggal_selesai'=> 'date',
    ];
}
