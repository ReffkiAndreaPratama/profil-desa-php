<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::orderByDesc('created_at');
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $aspirasi = $query->paginate(15)->withQueryString();
        return view('admin.aspirasi.index', compact('aspirasi'));
    }

    public function show(Aspirasi $aspirasi)
    {
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'status'  => 'required|in:diterima,diproses,selesai,ditolak',
            'balasan' => 'nullable|string|max:1000',
        ]);
        $aspirasi->update([
            'status'  => $request->status,
            'balasan' => $request->balasan,
        ]);
        return back()->with('success', 'Status aspirasi diperbarui!');
    }

    public function destroy(Aspirasi $aspirasi)
    {
        $aspirasi->delete();
        return back()->with('success', 'Aspirasi dihapus!');
    }

    public function create() { return redirect()->route('admin.aspirasi.index'); }
    public function store(Request $request) { return redirect()->route('admin.aspirasi.index'); }
    public function edit(Aspirasi $aspirasi) { return redirect()->route('admin.aspirasi.show', $aspirasi); }
    public function update(Request $request, Aspirasi $aspirasi) { return redirect()->route('admin.aspirasi.index'); }
}
