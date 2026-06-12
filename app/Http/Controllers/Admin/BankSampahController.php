<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampahNasabah;
use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'nama','label'=>'Nama Nasabah','required'=>true],
            ['name'=>'nik','label'=>'NIK'],
            ['name'=>'alamat','label'=>'Alamat'],
            ['name'=>'no_hp','label'=>'No. HP'],
            ['name'=>'poin','label'=>'Total Poin','type'=>'number','default'=>'0'],
            ['name'=>'aktif','label'=>'Status Aktif','type'=>'checkbox','hint'=>'Nasabah aktif'],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'Bank Sampah - Nasabah','createRoute'=>'admin.bank-sampah.create',
            'editRoute'=>'admin.bank-sampah.edit','deleteRoute'=>'admin.bank-sampah.destroy',
            'items'=>BankSampahNasabah::orderByDesc('poin')->paginate(20),
            'columns'=>['nama','alamat','no_hp','poin','aktif']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Nasabah Bank Sampah','item'=>null,
            'storeRoute'=>'admin.bank-sampah.store','updateRoute'=>'admin.bank-sampah.update','indexRoute'=>'admin.bank-sampah.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nama'=>'required']);
        BankSampahNasabah::create(array_merge($request->only('nama','nik','alamat','no_hp'), ['poin'=>0,'aktif'=>true]));
        return redirect()->route('admin.bank-sampah.index')->with('success','Nasabah ditambahkan!');
    }

    public function edit(BankSampahNasabah $bankSampah)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Nasabah Bank Sampah','item'=>$bankSampah,
            'storeRoute'=>'admin.bank-sampah.store','updateRoute'=>'admin.bank-sampah.update','indexRoute'=>'admin.bank-sampah.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, BankSampahNasabah $bankSampah)
    {
        $request->validate(['nama'=>'required']);
        $bankSampah->update($request->only('nama','nik','alamat','no_hp','poin','aktif'));
        return redirect()->route('admin.bank-sampah.index')->with('success','Nasabah diperbarui!');
    }

    public function destroy(BankSampahNasabah $bankSampah) { $bankSampah->delete(); return back()->with('success','Nasabah dihapus!'); }
    public function show(BankSampahNasabah $bankSampah) { return redirect()->route('admin.bank-sampah.edit', $bankSampah); }
}
