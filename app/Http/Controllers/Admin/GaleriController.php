<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'judul','label'=>'Judul Foto','required'=>true],
            ['name'=>'kategori','label'=>'Kategori','type'=>'select','options'=>['Kegiatan','Pembangunan','Wisata','Budaya','Lingkungan','Lainnya'],'required'=>true],
            ['name'=>'foto','label'=>'URL Foto','required'=>true,'placeholder'=>'https://...'],
            ['name'=>'tanggal','label'=>'Tanggal','type'=>'date','required'=>true],
        ];
    }

    public function index()
    {
        return view('admin.galeri.index', ['galeri' => Galeri::orderByDesc('tanggal')->paginate(20)]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Galeri','item'=>null,
            'storeRoute'=>'admin.galeri.store','updateRoute'=>'admin.galeri.update','indexRoute'=>'admin.galeri.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['judul'=>'required','kategori'=>'required','foto'=>'required','tanggal'=>'required|date']);
        Galeri::create($request->only('judul','kategori','foto','tanggal'));
        return redirect()->route('admin.galeri.index')->with('success','Foto galeri ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Galeri','item'=>$galeri,
            'storeRoute'=>'admin.galeri.store','updateRoute'=>'admin.galeri.update','indexRoute'=>'admin.galeri.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate(['judul'=>'required','kategori'=>'required','foto'=>'required','tanggal'=>'required|date']);
        $galeri->update($request->only('judul','kategori','foto','tanggal'));
        return redirect()->route('admin.galeri.index')->with('success','Foto galeri diperbarui!');
    }

    public function destroy(Galeri $galeri) { $galeri->delete(); return back()->with('success','Foto dihapus!'); }
    public function show(Galeri $galeri) { return redirect()->route('admin.galeri.edit', $galeri); }
}
