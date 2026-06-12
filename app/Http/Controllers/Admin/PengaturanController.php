<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $settings = Pengaturan::pluck('value', 'key')->toArray();
        return view('admin.pengaturan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_desa'       => 'required|string|max:100',
            'kecamatan'       => 'required|string|max:100',
            'kabupaten'       => 'required|string|max:100',
            'provinsi'        => 'required|string|max:100',
            'kepala_desa'     => 'required|string|max:100',
            'whatsapp'        => 'required|string|max:20',
            'email'           => 'required|email|max:100',
            'alamat'          => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:100',
        ]);

        $keys = [
            'nama_desa','kecamatan','kabupaten','provinsi','tagline',
            'kepala_desa','whatsapp','email','alamat','jam_operasional',
            'instagram','facebook','tiktok','youtube',
            'jumlah_penduduk','jumlah_kk','luas_wilayah','jumlah_dusun',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Pengaturan::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
