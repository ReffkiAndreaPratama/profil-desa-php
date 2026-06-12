<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class KknProkerController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'nama','label'=>'Nama Program','required'=>true],
            ['name'=>'kategori','label'=>'Kategori','type'=>'select','options'=>['Digitalisasi','Ekonomi','Kesehatan','Pertanian','Lingkungan','Pendidikan'],'required'=>true],
            ['name'=>'deskripsi','label'=>'Deskripsi','type'=>'textarea','required'=>true],
            ['name'=>'status','label'=>'Status','type'=>'select','options'=>['planned','ongoing','completed']],
            ['name'=>'progress','label'=>'Progress (%)','type'=>'number','default'=>'0'],
            ['name'=>'target','label'=>'Target'],
            ['name'=>'output','label'=>'Output'],
            ['name'=>'tanggal_mulai','label'=>'Tanggal Mulai','type'=>'date'],
            ['name'=>'tanggal_selesai','label'=>'Tanggal Selesai','type'=>'date'],
            ['name'=>'pic','label'=>'PIC (Penanggung Jawab)'],
            ['name'=>'icon','label'=>'Icon Emoji','placeholder'=>'💻'],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'Program Kerja KKN','createRoute'=>'admin.kkn-proker.create',
            'editRoute'=>'admin.kkn-proker.edit','deleteRoute'=>'admin.kkn-proker.destroy',
            'items'=>ProgramKerja::orderBy('id')->paginate(15),
            'columns'=>['nama','kategori','status','progress','pic']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Program Kerja','item'=>null,
            'storeRoute'=>'admin.kkn-proker.store','updateRoute'=>'admin.kkn-proker.update','indexRoute'=>'admin.kkn-proker.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nama'=>'required','kategori'=>'required','deskripsi'=>'required']);
        ProgramKerja::create($request->only('nama','kategori','deskripsi','status','progress','target','output','tanggal_mulai','tanggal_selesai','pic','icon'));
        return redirect()->route('admin.kkn-proker.index')->with('success','Program kerja ditambahkan!');
    }

    public function edit(ProgramKerja $kknProker)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Program Kerja','item'=>$kknProker,
            'storeRoute'=>'admin.kkn-proker.store','updateRoute'=>'admin.kkn-proker.update','indexRoute'=>'admin.kkn-proker.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, ProgramKerja $kknProker)
    {
        $request->validate(['nama'=>'required','kategori'=>'required','deskripsi'=>'required']);
        $kknProker->update($request->only('nama','kategori','deskripsi','status','progress','target','output','tanggal_mulai','tanggal_selesai','pic','icon'));
        return redirect()->route('admin.kkn-proker.index')->with('success','Program kerja diperbarui!');
    }

    public function destroy(ProgramKerja $kknProker) { $kknProker->delete(); return back()->with('success','Program kerja dihapus!'); }
    public function show(ProgramKerja $kknProker) { return redirect()->route('admin.kkn-proker.edit', $kknProker); }
}
