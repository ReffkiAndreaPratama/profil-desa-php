<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesImageUpload;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    use HandlesImageUpload;

    private function fields(): array
    {
        return [
            ['name' => 'nama',            'label' => 'Nama Wisata',           'required' => true],
            ['name' => 'kategori',        'label' => 'Kategori',              'type' => 'select', 'required' => true,
                'options' => ['Alam', 'Agrowisata', 'Budaya', 'Edukasi']],
            ['name' => 'deskripsi',       'label' => 'Deskripsi',             'type' => 'textarea', 'required' => true],
            ['name' => 'fasilitas',       'label' => 'Fasilitas (pisah koma)','placeholder' => 'Parkir, Toilet, Warung'],
            ['name' => 'harga',           'label' => 'Harga',                 'placeholder' => 'Rp 10.000/orang'],
            ['name' => 'jam_operasional', 'label' => 'Jam Operasional',       'placeholder' => '07.00 - 17.00 WIB'],
            ['name' => 'maps',            'label' => 'Link Google Maps'],
            ['name' => 'rating',          'label' => 'Rating',                'type' => 'number', 'placeholder' => '4.7'],
            ['name' => 'pengunjung',      'label' => 'Pengunjung/Bulan',      'placeholder' => '500+/bulan'],
            ['name' => 'published',       'label' => 'Status',                'type' => 'checkbox',
                'hint' => 'Tampilkan di halaman publik'],
        ];
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'nama'            => 'required',
            'kategori'        => 'required',
            'foto'            => 'nullable|string',
            'foto_upload'     => 'nullable|image|max:2048',
            'deskripsi'       => 'required',
            'harga'           => 'nullable',
            'jam_operasional' => 'nullable',
            'maps'            => 'nullable',
            'rating'          => 'nullable|numeric',
            'pengunjung'      => 'nullable',
        ]);
    }

    public function index()
    {
        return view('admin.shared.generic_index', [
            'title'       => 'Wisata',
            'createRoute' => 'admin.wisata.create',
            'editRoute'   => 'admin.wisata.edit',
            'deleteRoute' => 'admin.wisata.destroy',
            'items'       => Wisata::paginate(15),
            'columns'     => ['nama', 'kategori', 'harga', 'rating', 'pengunjung'],
        ]);
    }

    public function create()
    {
        return view('admin.wisata.form', ['wisata' => null, 'fields' => $this->fields()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $data['fasilitas'] = array_filter(array_map('trim', explode(',', $request->fasilitas ?? '')));
        $data['published'] = $request->boolean('published');
        $data['foto']      = $this->handleFoto($request, 'wisata');

        Wisata::create($data);
        return redirect()->route('admin.wisata.index')->with('success', 'Wisata ditambahkan!');
    }

    public function edit(Wisata $wisata)
    {
        return view('admin.wisata.form', ['wisata' => $wisata, 'fields' => $this->fields()]);
    }

    public function update(Request $request, Wisata $wisata)
    {
        $data = $this->validateRequest($request);
        $data['fasilitas'] = array_filter(array_map('trim', explode(',', $request->fasilitas ?? '')));
        $data['published'] = $request->boolean('published');
        $data['foto']      = $this->handleFoto($request, 'wisata', $wisata->foto);

        $wisata->update($data);
        return redirect()->route('admin.wisata.index')->with('success', 'Wisata diperbarui!');
    }

    public function destroy(Wisata $wisata)
    {
        $wisata->delete();
        return back()->with('success', 'Wisata dihapus!');
    }

    public function show(Wisata $wisata)
    {
        return redirect()->route('admin.wisata.edit', $wisata);
    }
}
