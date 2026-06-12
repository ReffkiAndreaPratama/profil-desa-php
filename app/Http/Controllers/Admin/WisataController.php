<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index() { return view('admin.crud.generic_index', ['title'=>'Wisata','createRoute'=>'admin.wisata.create','editRoute'=>'admin.wisata.edit','deleteRoute'=>'admin.wisata.destroy','items'=>Wisata::paginate(15),'columns'=>['nama','kategori','harga','rating','pengunjung']]); }
    public function create() {
        return view('admin.crud.generic_form', [
            'title'=>'Wisata','item'=>null,
            'storeRoute'=>'admin.wisata.store','updateRoute'=>'admin.wisata.update','indexRoute'=>'admin.wisata.index',
            'fields'=>[
                ['name'=>'nama','label'=>'Nama Wisata','required'=>true],
                ['name'=>'kategori','label'=>'Kategori','type'=>'select','options'=>['Alam','Agrowisata','Budaya','Edukasi'],'required'=>true],
                ['name'=>'foto','label'=>'URL Foto','placeholder'=>'https://images.unsplash.com/...'],
                ['name'=>'deskripsi','label'=>'Deskripsi','type'=>'textarea','required'=>true],
                ['name'=>'fasilitas','label'=>'Fasilitas (pisah koma)','placeholder'=>'Parkir, Toilet, Warung'],
                ['name'=>'harga','label'=>'Harga','placeholder'=>'Rp 10.000/orang'],
                ['name'=>'jam_operasional','label'=>'Jam Operasional','placeholder'=>'07.00 - 17.00 WIB'],
                ['name'=>'maps','label'=>'Link Google Maps'],
                ['name'=>'rating','label'=>'Rating','type'=>'number','placeholder'=>'4.7'],
                ['name'=>'pengunjung','label'=>'Pengunjung/Bulan','placeholder'=>'500+/bulan'],
                ['name'=>'published','label'=>'Status','type'=>'checkbox','hint'=>'Tampilkan di halaman publik'],
            ]
        ]);
    }
    public function store(Request $request) {
        $data = $request->validate(['nama'=>'required','kategori'=>'required','foto'=>'nullable','deskripsi'=>'required','harga'=>'nullable','jam_operasional'=>'nullable','maps'=>'nullable','rating'=>'nullable|numeric','pengunjung'=>'nullable']);
        $data['fasilitas'] = array_filter(explode(',', $request->fasilitas ?? ''));
        $data['published'] = $request->boolean('published');
        Wisata::create($data);
        return redirect()->route('admin.wisata.index')->with('success','Wisata ditambahkan!');
    }
    public function edit(Wisata $wisata) {
        return view('admin.crud.generic_form', [
            'title'=>'Wisata','item'=>$wisata,
            'storeRoute'=>'admin.wisata.store','updateRoute'=>'admin.wisata.update','indexRoute'=>'admin.wisata.index',
            'fields'=>[
                ['name'=>'nama','label'=>'Nama Wisata','required'=>true],
                ['name'=>'kategori','label'=>'Kategori','type'=>'select','options'=>['Alam','Agrowisata','Budaya','Edukasi'],'required'=>true],
                ['name'=>'foto','label'=>'URL Foto','placeholder'=>'https://images.unsplash.com/...'],
                ['name'=>'deskripsi','label'=>'Deskripsi','type'=>'textarea','required'=>true],
                ['name'=>'fasilitas','label'=>'Fasilitas (pisah koma)','placeholder'=>'Parkir, Toilet, Warung'],
                ['name'=>'harga','label'=>'Harga','placeholder'=>'Rp 10.000/orang'],
                ['name'=>'jam_operasional','label'=>'Jam Operasional','placeholder'=>'07.00 - 17.00 WIB'],
                ['name'=>'maps','label'=>'Link Google Maps'],
                ['name'=>'rating','label'=>'Rating','type'=>'number','placeholder'=>'4.7'],
                ['name'=>'pengunjung','label'=>'Pengunjung/Bulan','placeholder'=>'500+/bulan'],
                ['name'=>'published','label'=>'Status','type'=>'checkbox','hint'=>'Tampilkan di halaman publik'],
            ]
        ]);
    }
    public function update(Request $request, Wisata $wisata) {
        $data = $request->validate(['nama'=>'required','kategori'=>'required','foto'=>'nullable','deskripsi'=>'required','harga'=>'nullable','jam_operasional'=>'nullable','maps'=>'nullable','rating'=>'nullable|numeric','pengunjung'=>'nullable']);
        $data['fasilitas'] = array_filter(explode(',', $request->fasilitas ?? ''));
        $data['published'] = $request->boolean('published');
        $wisata->update($data);
        return redirect()->route('admin.wisata.index')->with('success','Wisata diperbarui!');
    }
    public function destroy(Wisata $wisata) { $wisata->delete(); return back()->with('success','Wisata dihapus!'); }
    public function show(Wisata $wisata) { return redirect()->route('admin.wisata.edit', $wisata); }
}
