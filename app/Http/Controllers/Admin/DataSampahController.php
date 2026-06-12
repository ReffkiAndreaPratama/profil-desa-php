<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSampah;
use Illuminate\Http\Request;

class DataSampahController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'bulan','label'=>'Bulan (format: 2025-06)','required'=>true,'placeholder'=>'2025-06'],
            ['name'=>'total','label'=>'Total Sampah (kg)','type'=>'number','required'=>true],
            ['name'=>'organik','label'=>'Organik (kg)','type'=>'number','required'=>true],
            ['name'=>'anorganik','label'=>'Anorganik (kg)','type'=>'number','required'=>true],
            ['name'=>'b3','label'=>'B3 (kg)','type'=>'number','required'=>true],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'Data Sampah Bulanan','createRoute'=>'admin.data-sampah.create',
            'editRoute'=>'admin.data-sampah.edit','deleteRoute'=>'admin.data-sampah.destroy',
            'items'=>DataSampah::orderByDesc('bulan')->paginate(15),
            'columns'=>['bulan','total','organik','anorganik','b3']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Data Sampah','item'=>null,
            'storeRoute'=>'admin.data-sampah.store','updateRoute'=>'admin.data-sampah.update','indexRoute'=>'admin.data-sampah.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['bulan'=>'required','total'=>'required|integer','organik'=>'required|integer','anorganik'=>'required|integer','b3'=>'required|integer']);
        DataSampah::create($request->only('bulan','total','organik','anorganik','b3'));
        return redirect()->route('admin.data-sampah.index')->with('success','Data sampah ditambahkan!');
    }

    public function edit(DataSampah $dataSampah)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Data Sampah','item'=>$dataSampah,
            'storeRoute'=>'admin.data-sampah.store','updateRoute'=>'admin.data-sampah.update','indexRoute'=>'admin.data-sampah.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, DataSampah $dataSampah)
    {
        $request->validate(['bulan'=>'required','total'=>'required|integer']);
        $dataSampah->update($request->only('bulan','total','organik','anorganik','b3'));
        return redirect()->route('admin.data-sampah.index')->with('success','Data diperbarui!');
    }

    public function destroy(DataSampah $dataSampah) { $dataSampah->delete(); return back()->with('success','Data dihapus!'); }
    public function show(DataSampah $dataSampah) { return redirect()->route('admin.data-sampah.edit', $dataSampah); }
}
