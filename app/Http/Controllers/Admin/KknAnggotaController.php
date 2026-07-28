<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesImageUpload;
use App\Models\AnggotaKkn;
use Illuminate\Http\Request;

class KknAnggotaController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        return view('admin.shared.generic_index', [
            'title'       => 'Anggota KKN',
            'createRoute' => 'admin.kkn-anggota.create',
            'editRoute'   => 'admin.kkn-anggota.edit',
            'deleteRoute' => 'admin.kkn-anggota.destroy',
            'items'       => AnggotaKkn::orderBy('id')->paginate(20),
            'columns'     => ['nama', 'prodi', 'fakultas', 'posisi', 'nim'],
        ]);
    }

    public function create()
    {
        return view('admin.kkn.form-anggota', ['anggota' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'prodi'       => 'required',
            'fakultas'    => 'required',
            'posisi'      => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'nim'         => 'nullable',
            'instagram'   => 'nullable|string|max:100',
        ]);

        AnggotaKkn::create([
            'nama'      => $request->nama,
            'prodi'     => $request->prodi,
            'fakultas'  => $request->fakultas,
            'posisi'    => $request->posisi,
            'nim'       => $request->nim,
            'instagram' => $request->instagram,
            'foto'      => $this->handleFoto($request, 'kkn'),
        ]);

        return redirect()->route('admin.kkn-anggota.index')->with('success', 'Anggota KKN ditambahkan!');
    }

    public function edit(AnggotaKkn $kknAnggotum)
    {
        return view('admin.kkn.form-anggota', ['anggota' => $kknAnggotum]);
    }

    public function update(Request $request, AnggotaKkn $kknAnggotum)
    {
        $request->validate([
            'nama'        => 'required',
            'prodi'       => 'required',
            'fakultas'    => 'required',
            'posisi'      => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'nim'         => 'nullable',
            'instagram'   => 'nullable|string|max:100',
        ]);

        $kknAnggotum->update([
            'nama'      => $request->nama,
            'prodi'     => $request->prodi,
            'fakultas'  => $request->fakultas,
            'posisi'    => $request->posisi,
            'nim'       => $request->nim,
            'instagram' => $request->instagram,
            'foto'      => $this->handleFoto($request, 'kkn', $kknAnggotum->foto),
        ]);

        return redirect()->route('admin.kkn-anggota.index')->with('success', 'Anggota KKN diperbarui!');
    }

    public function destroy(AnggotaKkn $kknAnggotum)
    {
        $kknAnggotum->delete();
        return back()->with('success', 'Anggota dihapus!');
    }

    public function show(AnggotaKkn $kknAnggotum)
    {
        return redirect()->route('admin.kkn-anggota.edit', $kknAnggotum);
    }
}
