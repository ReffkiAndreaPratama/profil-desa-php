<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name' => 'judul',    'label' => 'Judul Kegiatan', 'required' => true],
            ['name' => 'tanggal',  'label' => 'Tanggal',        'type' => 'date',   'required' => true],
            ['name' => 'jam',      'label' => 'Jam',            'placeholder' => '08.00 WIB'],
            ['name' => 'lokasi',   'label' => 'Lokasi',         'placeholder' => 'Balai Desa'],
            ['name' => 'kategori', 'label' => 'Kategori',       'type' => 'select',
                'options' => ['Pemerintahan', 'Kesehatan', 'KKN', 'Sosial', 'Pendidikan', 'Keagamaan']],
            ['name' => 'deskripsi','label' => 'Deskripsi',      'type' => 'textarea'],
        ];
    }

    private function viewData(string $title, ?Agenda $item = null): array
    {
        return [
            'title'       => $title,
            'item'        => $item,
            'storeRoute'  => 'admin.agenda.store',
            'updateRoute' => 'admin.agenda.update',
            'indexRoute'  => 'admin.agenda.index',
            'fields'      => $this->formFields(),
        ];
    }

    public function index()
    {
        return view('admin.shared.generic_index', [
            'title'       => 'Agenda',
            'createRoute' => 'admin.agenda.create',
            'editRoute'   => 'admin.agenda.edit',
            'deleteRoute' => 'admin.agenda.destroy',
            'items'       => Agenda::orderByDesc('tanggal')->paginate(15),
            'columns'     => ['judul', 'tanggal', 'jam', 'lokasi', 'kategori'],
        ]);
    }

    public function create()
    {
        return view('admin.shared.generic_form', $this->viewData('Agenda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'tanggal' => 'required|date',
        ]);

        Agenda::create($request->only('judul', 'tanggal', 'jam', 'lokasi', 'kategori', 'deskripsi'));

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda ditambahkan!');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.shared.generic_form', $this->viewData('Agenda', $agenda));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul'   => 'required',
            'tanggal' => 'required|date',
        ]);

        $agenda->update($request->only('judul', 'tanggal', 'jam', 'lokasi', 'kategori', 'deskripsi'));

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda diperbarui!');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda dihapus!');
    }

    public function show(Agenda $agenda)
    {
        return redirect()->route('admin.agenda.edit', $agenda);
    }
}
