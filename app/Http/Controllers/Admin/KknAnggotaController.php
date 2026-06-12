<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKkn;
use Illuminate\Http\Request;

class KknAnggotaController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'nama','label'=>'Nama Lengkap','required'=>true],
            ['name'=>'nim','label'=>'NIM'],
            ['name'=>'prodi','label'=>'Program Studi','required'=>true],
            ['name'=>'fakultas','label'=>'Fakultas','required'=>true],
            ['name'=>'posisi','label'=>'Posisi','type'=>'select','options'=>['Ketua','Sekretaris','Bendahara','Anggota'],'required'=>true],
            ['name'=>'foto','label'=>'URL Foto'],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'Anggota KKN','createRoute'=>'admin.kkn-anggota.create',
            'editRoute'=>'admin.kkn-anggota.edit','deleteRoute'=>'admin.kkn-anggota.destroy',
            'items'=>AnggotaKkn::orderBy('id')->paginate(20),
            'columns'=>['nama','prodi','fakultas','posisi','nim']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Anggota KKN','item'=>null,
            'storeRoute'=>'admin.kkn-anggota.store','updateRoute'=>'admin.kkn-anggota.update','indexRoute'=>'admin.kkn-anggota.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nama'=>'required','prodi'=>'required','fakultas'=>'required','posisi'=>'required']);
        AnggotaKkn::create($request->only('nama','prodi','fakultas','posisi','foto','nim'));
        return redirect()->route('admin.kkn-anggota.index')->with('success','Anggota KKN ditambahkan!');
    }

    public function edit(AnggotaKkn $kknAnggotum)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Anggota KKN','item'=>$kknAnggotum,
            'storeRoute'=>'admin.kkn-anggota.store','updateRoute'=>'admin.kkn-anggota.update','indexRoute'=>'admin.kkn-anggota.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, AnggotaKkn $kknAnggotum)
    {
        $request->validate(['nama'=>'required','prodi'=>'required','fakultas'=>'required','posisi'=>'required']);
        $kknAnggotum->update($request->only('nama','prodi','fakultas','posisi','foto','nim'));
        return redirect()->route('admin.kkn-anggota.index')->with('success','Anggota KKN diperbarui!');
    }

    public function destroy(AnggotaKkn $kknAnggotum) { $kknAnggotum->delete(); return back()->with('success','Anggota dihapus!'); }
    public function show(AnggotaKkn $kknAnggotum) { return redirect()->route('admin.kkn-anggota.edit', $kknAnggotum); }
}
