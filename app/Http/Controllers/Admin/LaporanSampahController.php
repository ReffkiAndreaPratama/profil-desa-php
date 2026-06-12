<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanSampah;
use Illuminate\Http\Request;

class LaporanSampahController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanSampah::orderByDesc('created_at');
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $laporan = $query->paginate(15)->withQueryString();
        return view('admin.laporan-sampah.index', compact('laporan'));
    }

    public function show(LaporanSampah $laporanSampah)
    {
        return view('admin.laporan-sampah.show', ['laporan' => $laporanSampah]);
    }

    public function updateStatus(Request $request, LaporanSampah $laporan)
    {
        $request->validate([
            'status'        => 'required|in:diterima,diproses,selesai',
            'catatan_admin' => 'nullable|string|max:500',
        ]);
        $laporan->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);
        return back()->with('success', 'Status laporan diperbarui!');
    }

    public function destroy(LaporanSampah $laporanSampah)
    {
        $laporanSampah->delete();
        return back()->with('success', 'Laporan dihapus!');
    }

    public function create() { return redirect()->route('admin.laporan-sampah.index'); }
    public function store(Request $request) { return redirect()->route('admin.laporan-sampah.index'); }
    public function edit(LaporanSampah $laporanSampah) { return redirect()->route('admin.laporan-sampah.index'); }
    public function update(Request $request, LaporanSampah $laporanSampah) { return redirect()->route('admin.laporan-sampah.index'); }
}
