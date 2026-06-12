<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'nama','label'=>'Nama Produk/UMKM','required'=>true],
            ['name'=>'kategori','label'=>'Kategori','type'=>'select','options'=>['Makanan','Minuman','Kerajinan','Kesehatan','Pertanian','Lainnya'],'required'=>true],
            ['name'=>'foto','label'=>'URL Foto','placeholder'=>'https://...'],
            ['name'=>'deskripsi','label'=>'Deskripsi','type'=>'textarea','required'=>true],
            ['name'=>'harga','label'=>'Harga','placeholder'=>'Rp 45.000 - Rp 120.000'],
            ['name'=>'pemilik','label'=>'Pemilik'],
            ['name'=>'kontak','label'=>'Kontak WhatsApp','placeholder'=>'628...'],
            ['name'=>'stok','label'=>'Status Stok','type'=>'select','options'=>['Tersedia','Terbatas','Habis']],
            ['name'=>'lokasi','label'=>'Lokasi','placeholder'=>'Dusun I'],
            ['name'=>'published','label'=>'Publikasi','type'=>'checkbox','hint'=>'Tampilkan di publik'],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'UMKM','createRoute'=>'admin.umkm.create',
            'editRoute'=>'admin.umkm.edit','deleteRoute'=>'admin.umkm.destroy',
            'items'=>Umkm::paginate(15),'columns'=>['nama','kategori','pemilik','stok','lokasi']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'UMKM','item'=>null,
            'storeRoute'=>'admin.umkm.store','updateRoute'=>'admin.umkm.update','indexRoute'=>'admin.umkm.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama'=>'required','kategori'=>'required','foto'=>'nullable','deskripsi'=>'required','harga'=>'nullable','kontak'=>'nullable','pemilik'=>'nullable','stok'=>'nullable','lokasi'=>'nullable']);
        $data['published'] = $request->boolean('published');
        Umkm::create($data);
        return redirect()->route('admin.umkm.index')->with('success','UMKM ditambahkan!');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.crud.generic_form', [
            'title'=>'UMKM','item'=>$umkm,
            'storeRoute'=>'admin.umkm.store','updateRoute'=>'admin.umkm.update','indexRoute'=>'admin.umkm.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, Umkm $umkm)
    {
        $data = $request->validate(['nama'=>'required','kategori'=>'required','foto'=>'nullable','deskripsi'=>'required','harga'=>'nullable','kontak'=>'nullable','pemilik'=>'nullable','stok'=>'nullable','lokasi'=>'nullable']);
        $data['published'] = $request->boolean('published');
        $umkm->update($data);
        return redirect()->route('admin.umkm.index')->with('success','UMKM diperbarui!');
    }

    public function destroy(Umkm $umkm) { $umkm->delete(); return back()->with('success','UMKM dihapus!'); }
    public function show(Umkm $umkm) { return redirect()->route('admin.umkm.edit', $umkm); }
}
