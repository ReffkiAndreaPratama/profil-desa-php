<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesImageUpload;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        return view('admin.perangkat.index', [
            'items' => PerangkatDesa::orderBy('urutan')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.perangkat.form', ['perangkat' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan'     => 'required',
            'nama'        => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'kontak'      => 'nullable',
            'urutan'      => 'nullable|integer',
        ]);

        PerangkatDesa::create([
            'jabatan' => $request->jabatan,
            'nama'    => $request->nama,
            'kontak'  => $request->kontak,
            'urutan'  => $request->urutan ?? 0,
            'foto'    => $this->handleFoto($request, 'perangkat'),
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat ditambahkan!');
    }

    public function edit(PerangkatDesa $perangkat)
    {
        return view('admin.perangkat.form', compact('perangkat'));
    }

    public function update(Request $request, PerangkatDesa $perangkat)
    {
        $request->validate([
            'jabatan'     => 'required',
            'nama'        => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'kontak'      => 'nullable',
            'urutan'      => 'nullable|integer',
        ]);

        $perangkat->update([
            'jabatan' => $request->jabatan,
            'nama'    => $request->nama,
            'kontak'  => $request->kontak,
            'urutan'  => $request->urutan ?? 0,
            'foto'    => $this->handleFoto($request, 'perangkat', $perangkat->foto),
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat diperbarui!');
    }

    public function destroy(PerangkatDesa $perangkat)
    {
        $perangkat->delete();
        return back()->with('success', 'Perangkat dihapus!');
    }

    public function show(PerangkatDesa $perangkat)
    {
        return redirect()->route('admin.perangkat.edit', $perangkat);
    }
}
