<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::orderByDesc('created_at')->paginate(15);
        return view('admin.pesan-kontak.index', compact('pesan'));
    }

    public function show(PesanKontak $pesanKontak)
    {
        $pesanKontak->update(['sudah_dibaca' => true]);
        return view('admin.pesan-kontak.show', ['pesan' => $pesanKontak]);
    }

    public function markRead(PesanKontak $pesanKontak)
    {
        $pesanKontak->update(['sudah_dibaca' => true]);
        return back()->with('success', 'Pesan ditandai sudah dibaca!');
    }

    public function destroy(PesanKontak $pesanKontak)
    {
        $pesanKontak->delete();
        return back()->with('success', 'Pesan dihapus!');
    }

    public function create() { return redirect()->route('admin.pesan-kontak.index'); }
    public function store(Request $request) { return redirect()->route('admin.pesan-kontak.index'); }
    public function edit(PesanKontak $pesanKontak) { return redirect()->route('admin.pesan-kontak.index'); }
    public function update(Request $request, PesanKontak $pesanKontak) { return redirect()->route('admin.pesan-kontak.index'); }
}
