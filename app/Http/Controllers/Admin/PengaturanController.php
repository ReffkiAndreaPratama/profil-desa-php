<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Http\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    use HandlesImageUpload;

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
            'maps_desa'       => 'nullable|url|max:500',
            'koordinat_desa'  => 'nullable|string|max:100',
            'visi'            => 'nullable|string',
            'misi'            => 'nullable|string',
            'sejarah'         => 'nullable|string',
            'pekerjaan'       => 'nullable|string',
            'foto'            => 'nullable|string',
            'foto_upload'     => 'nullable|image|max:2048',
        ]);

        $keys = [
            'nama_desa','kecamatan','kabupaten','provinsi','tagline',
            'kepala_desa','whatsapp','email','alamat','jam_operasional',
            'instagram','facebook','tiktok','youtube',
            'jumlah_penduduk','jumlah_kk','luas_wilayah','jumlah_dusun',
            'maps_desa','koordinat_desa',
            'visi', 'misi', 'sejarah', 'pekerjaan',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Pengaturan::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        // Handle logo file upload
        $logo = $this->handleFoto($request, 'logo', Pengaturan::where('key', 'logo')->value('value'));
        if ($logo !== null) {
            Pengaturan::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $logo]
            );
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
