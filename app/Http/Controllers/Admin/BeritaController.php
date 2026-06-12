<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::orderByDesc('tanggal');
        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }
        $berita = $query->paginate(15)->withQueryString();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.form', ['berita' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'penulis'  => 'required|string|max:100',
            'ringkasan'=> 'required|string',
            'konten'   => 'required|string',
            'foto'     => 'nullable|url|max:500',
            'published'=> 'boolean',
        ]);

        $validated['views']     = 0;
        $validated['published'] = $request->boolean('published');

        Berita::create($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'penulis'  => 'required|string|max:100',
            'ringkasan'=> 'required|string',
            'konten'   => 'required|string',
            'foto'     => 'nullable|url|max:500',
            'published'=> 'boolean',
        ]);

        $validated['published'] = $request->boolean('published');
        $berita->update($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}
