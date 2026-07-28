<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name' => 'nama',     'label' => 'Nama Dokumen', 'required' => true],
            ['name' => 'kategori', 'label' => 'Kategori',     'type' => 'select', 'required' => true,
                'options' => ['Perencanaan', 'Keuangan', 'Profil', 'Peraturan', 'Laporan', 'Data']],
            ['name' => 'tanggal',  'label' => 'Tanggal',      'type' => 'date'],
            ['name' => 'tipe',     'label' => 'Tipe File',    'placeholder' => 'PDF'],
            ['name' => 'ukuran',   'label' => 'Ukuran',       'placeholder' => '2.4 MB'],
            ['name' => 'url',      'label' => 'URL Download', 'placeholder' => 'https://drive.google.com/...'],
        ];
    }

    private function viewData(string $title, ?Dokumen $item = null): array
    {
        return [
            'title'       => $title,
            'item'        => $item,
            'storeRoute'  => 'admin.dokumen.store',
            'updateRoute' => 'admin.dokumen.update',
            'indexRoute'  => 'admin.dokumen.index',
            'fields'      => $this->formFields(),
        ];
    }

    public function index()
    {
        return view('admin.shared.generic_index', [
            'title'       => 'Dokumen',
            'createRoute' => 'admin.dokumen.create',
            'editRoute'   => 'admin.dokumen.edit',
            'deleteRoute' => 'admin.dokumen.destroy',
            'items'       => Dokumen::orderByDesc('tanggal')->paginate(15),
            'columns'     => ['nama', 'kategori', 'tanggal', 'tipe', 'ukuran'],
        ]);
    }

    public function create()
    {
        return view('admin.shared.generic_form', $this->viewData('Dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'kategori' => 'required',
        ]);

        Dokumen::create($request->only('nama', 'kategori', 'tanggal', 'ukuran', 'tipe', 'url'));

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen ditambahkan!');
    }

    public function edit(Dokumen $dokumen)
    {
        return view('admin.shared.generic_form', $this->viewData('Dokumen', $dokumen));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'nama'     => 'required',
            'kategori' => 'required',
        ]);

        $dokumen->update($request->only('nama', 'kategori', 'tanggal', 'ukuran', 'tipe', 'url'));

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen diperbarui!');
    }

    public function destroy(Dokumen $dokumen)
    {
        $dokumen->delete();
        return back()->with('success', 'Dokumen dihapus!');
    }

    public function show(Dokumen $dokumen)
    {
        return redirect()->route('admin.dokumen.edit', $dokumen);
    }
}
