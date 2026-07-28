<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesImageUpload;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    use HandlesImageUpload;

    private function formFields(): array
    {
        return [
            ['name' => 'judul',    'label' => 'Judul Foto', 'required' => true],
            ['name' => 'kategori', 'label' => 'Kategori',   'type' => 'select', 'required' => true,
                'options' => ['Kegiatan', 'Pembangunan', 'Wisata', 'Budaya', 'Lingkungan', 'Lainnya']],
            ['name' => 'tanggal',  'label' => 'Tanggal',    'type' => 'date', 'required' => true],
        ];
    }

    public function index()
    {
        return view('admin.galeri.index', [
            'galeri' => Galeri::orderByDesc('tanggal')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.galeri.form', ['galeri' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required',
            'kategori'    => 'required',
            'tanggal'     => 'required|date',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
        ]);

        $foto = $this->handleFoto($request, 'galeri');
        if (!$foto) {
            return back()->withErrors(['foto' => 'Foto wajib diisi (URL atau upload)'])->withInput();
        }

        Galeri::create([
            'judul'    => $request->judul,
            'kategori' => $request->kategori,
            'tanggal'  => $request->tanggal,
            'foto'     => $foto,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'       => 'required',
            'kategori'    => 'required',
            'tanggal'     => 'required|date',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
        ]);

        $galeri->update([
            'judul'    => $request->judul,
            'kategori' => $request->kategori,
            'tanggal'  => $request->tanggal,
            'foto'     => $this->handleFoto($request, 'galeri', $galeri->foto),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return back()->with('success', 'Foto dihapus!');
    }

    public function show(Galeri $galeri)
    {
        return redirect()->route('admin.galeri.edit', $galeri);
    }
}
