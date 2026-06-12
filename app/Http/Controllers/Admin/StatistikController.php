<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikDesa;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    private function formFields(): array
    {
        return [
            ['name'=>'tahun','label'=>'Tahun','type'=>'number','required'=>true],
            ['name'=>'penduduk','label'=>'Total Penduduk','type'=>'number','required'=>true],
            ['name'=>'kk','label'=>'Jumlah KK','type'=>'number'],
            ['name'=>'laki_laki','label'=>'Laki-laki','type'=>'number'],
            ['name'=>'perempuan','label'=>'Perempuan','type'=>'number'],
            ['name'=>'umkm','label'=>'Jumlah UMKM','type'=>'number'],
        ];
    }

    public function index()
    {
        return view('admin.crud.generic_index', [
            'title'=>'Statistik Desa','createRoute'=>'admin.statistik.create',
            'editRoute'=>'admin.statistik.edit','deleteRoute'=>'admin.statistik.destroy',
            'items'=>StatistikDesa::orderByDesc('tahun')->paginate(15),
            'columns'=>['tahun','penduduk','kk','laki_laki','perempuan','umkm']
        ]);
    }

    public function create()
    {
        return view('admin.crud.generic_form', [
            'title'=>'Statistik Desa','item'=>null,
            'storeRoute'=>'admin.statistik.store','updateRoute'=>'admin.statistik.update','indexRoute'=>'admin.statistik.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['tahun'=>'required|integer','penduduk'=>'required|integer']);
        StatistikDesa::create($request->only('tahun','penduduk','kk','laki_laki','perempuan','umkm'));
        return redirect()->route('admin.statistik.index')->with('success','Data statistik ditambahkan!');
    }

    public function edit(StatistikDesa $statistik)
    {
        return view('admin.crud.generic_form', [
            'title'=>'Statistik Desa','item'=>$statistik,
            'storeRoute'=>'admin.statistik.store','updateRoute'=>'admin.statistik.update','indexRoute'=>'admin.statistik.index',
            'fields'=>$this->formFields()
        ]);
    }

    public function update(Request $request, StatistikDesa $statistik)
    {
        $request->validate(['tahun'=>'required|integer','penduduk'=>'required|integer']);
        $statistik->update($request->only('tahun','penduduk','kk','laki_laki','perempuan','umkm'));
        return redirect()->route('admin.statistik.index')->with('success','Data statistik diperbarui!');
    }

    public function destroy(StatistikDesa $statistik) { $statistik->delete(); return back()->with('success','Data dihapus!'); }
    public function show(StatistikDesa $statistik) { return redirect()->route('admin.statistik.edit', $statistik); }
}
