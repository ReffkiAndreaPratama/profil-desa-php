<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'jabatan','label'=>'Jabatan','required'=>true,'placeholder'=>'Kepala Desa'],
            ['name'=>'nama','label'=>'Nama Lengkap','required'=>true],
            ['name'=>'foto','label'=>'URL Foto','placeholder'=>'https://...'],
            ['name'=>'kontak','label'=>'No. HP/WA','placeholder'=>'08xxx'],
            ['name'=>'urutan','label'=>'Urutan Tampil','type'=>'number','default'=>'0'],
        ];
    }

    public function index()
    {
        return view('admin.crud.perangkat_index', ['items' => PerangkatDesa::orderBy('urutan')->get()]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Perangkat Desa','item'=>null,
            'storeRoute'=>'admin.perangkat.store','updateRoute'=>'admin.perangkat.update','indexRoute'=>'admin.perangkat.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['jabatan'=>'required','nama'=>'required']);
        PerangkatDesa::create($request->only('jabatan','nama','foto','kontak','urutan'));
        return redirect()->route('admin.perangkat.index')->with('success','Perangkat ditambahkan!');
    }

    public function edit(PerangkatDesa $perangkat)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Perangkat Desa','item'=>$perangkat,
            'storeRoute'=>'admin.perangkat.store','updateRoute'=>'admin.perangkat.update','indexRoute'=>'admin.perangkat.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, PerangkatDesa $perangkat)
    {
        $request->validate(['jabatan'=>'required','nama'=>'required']);
        $perangkat->update($request->only('jabatan','nama','foto','kontak','urutan'));
        return redirect()->route('admin.perangkat.index')->with('success','Perangkat diperbarui!');
    }

    public function destroy(PerangkatDesa $perangkat) { $perangkat->delete(); return back()->with('success','Perangkat dihapus!'); }
    public function show(PerangkatDesa $perangkat) { return redirect()->route('admin.perangkat.edit', $perangkat); }
}
