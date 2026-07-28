<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesImageUpload;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    use HandlesImageUpload;

    private function formFields(): array
    {
        return [
            ['name' => 'nama',      'label' => 'Nama Produk / UMKM', 'required' => true],
            ['name' => 'kategori',  'label' => 'Kategori',            'type' => 'select', 'required' => true,
                'options' => ['Makanan', 'Minuman', 'Kerajinan', 'Kesehatan', 'Pertanian', 'Lainnya']],
            ['name' => 'deskripsi', 'label' => 'Deskripsi',           'type' => 'textarea', 'required' => true],
            ['name' => 'harga',     'label' => 'Harga',               'placeholder' => 'Rp 45.000 - Rp 120.000'],
            ['name' => 'pemilik',   'label' => 'Pemilik'],
            ['name' => 'kontak',    'label' => 'Kontak WhatsApp',     'placeholder' => '628...'],
            ['name' => 'stok',      'label' => 'Status Stok',         'type' => 'select',
                'options' => ['Tersedia', 'Terbatas', 'Habis']],
            ['name' => 'lokasi',    'label' => 'Lokasi',              'placeholder' => 'Dusun I'],
            ['name' => 'published', 'label' => 'Publikasi',           'type' => 'checkbox',
                'hint' => 'Tampilkan di halaman publik'],
        ];
    }

    private function viewData(string $title, ?Umkm $item = null): array
    {
        return [
            'title'       => $title,
            'item'        => $item,
            'storeRoute'  => 'admin.umkm.store',
            'updateRoute' => 'admin.umkm.update',
            'indexRoute'  => 'admin.umkm.index',
            'fields'      => $this->formFields(),
        ];
    }

    public function index()
    {
        return view('admin.shared.generic_index', [
            'title'       => 'UMKM',
            'createRoute' => 'admin.umkm.create',
            'editRoute'   => 'admin.umkm.edit',
            'deleteRoute' => 'admin.umkm.destroy',
            'items'       => Umkm::paginate(15),
            'columns'     => ['nama', 'kategori', 'pemilik', 'stok', 'lokasi'],
        ]);
    }

    public function create()
    {
        return view('admin.umkm.form', $this->viewData('UMKM'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required',
            'kategori'    => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'deskripsi'   => 'required',
            'harga'       => 'nullable',
            'kontak'      => 'nullable',
            'pemilik'     => 'nullable',
            'stok'        => 'nullable',
            'lokasi'      => 'nullable',
        ]);

        $data['foto']      = $this->handleFoto($request, 'umkm');
        $data['published'] = $request->boolean('published');

        Umkm::create($data);
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM ditambahkan!');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.form', $this->viewData('UMKM', $umkm));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'nama'        => 'required',
            'kategori'    => 'required',
            'foto'        => 'nullable|string',
            'foto_upload' => 'nullable|image|max:2048',
            'deskripsi'   => 'required',
            'harga'       => 'nullable',
            'kontak'      => 'nullable',
            'pemilik'     => 'nullable',
            'stok'        => 'nullable',
            'lokasi'      => 'nullable',
        ]);

        $data['foto']      = $this->handleFoto($request, 'umkm', $umkm->foto);
        $data['published'] = $request->boolean('published');

        $umkm->update($data);
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM diperbarui!');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return back()->with('success', 'UMKM dihapus!');
    }

    public function show(Umkm $umkm)
    {
        return redirect()->route('admin.umkm.edit', $umkm);
    }
}
