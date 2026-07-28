<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetaRumah;
use Illuminate\Http\Request;

class PetaRumahController extends Controller
{
    public function index(Request $request)
    {
        $query = PetaRumah::orderBy('no_rumah');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('no_rumah', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_kk',  'like', '%' . $request->search . '%')
                  ->orWhere('dusun',    'like', '%' . $request->search . '%');
            });
        }

        if ($request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        $rumah  = $query->paginate(20)->withQueryString();
        $dusuns = PetaRumah::whereNotNull('dusun')->distinct()->pluck('dusun')->sort()->values();

        return view('admin.peta-rumah.index', compact('rumah', 'dusuns'));
    }

    public function create()
    {
        return view('admin.peta-rumah.form', ['rumah' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_rumah'     => 'required|string|max:20',
            'nama_kk'      => 'required|string|max:100',
            'alamat'       => 'nullable|string|max:255',
            'rt'           => 'nullable|string|max:10',
            'rw'           => 'nullable|string|max:10',
            'dusun'        => 'nullable|string|max:50',
            'lat'          => 'required|numeric|between:-90,90',
            'lng'          => 'required|numeric|between:-180,180',
            'jumlah_jiwa'  => 'nullable|integer|min:1',
            'status_rumah' => 'nullable|string',
            'keterangan'   => 'nullable|string|max:500',
            'aktif'        => 'boolean',
        ]);

        $data['aktif'] = $request->boolean('aktif', true);

        PetaRumah::create($data);

        return redirect()->route('admin.peta-rumah.index')
            ->with('success', 'Data rumah berhasil ditambahkan!');
    }

    public function edit(PetaRumah $petaRumah)
    {
        return view('admin.peta-rumah.form', ['rumah' => $petaRumah]);
    }

    public function update(Request $request, PetaRumah $petaRumah)
    {
        $data = $request->validate([
            'no_rumah'     => 'required|string|max:20',
            'nama_kk'      => 'required|string|max:100',
            'alamat'       => 'nullable|string|max:255',
            'rt'           => 'nullable|string|max:10',
            'rw'           => 'nullable|string|max:10',
            'dusun'        => 'nullable|string|max:50',
            'lat'          => 'required|numeric|between:-90,90',
            'lng'          => 'required|numeric|between:-180,180',
            'jumlah_jiwa'  => 'nullable|integer|min:1',
            'status_rumah' => 'nullable|string',
            'keterangan'   => 'nullable|string|max:500',
        ]);

        $data['aktif'] = $request->boolean('aktif', true);

        $petaRumah->update($data);

        return redirect()->route('admin.peta-rumah.index')
            ->with('success', 'Data rumah berhasil diperbarui!');
    }

    public function destroy(PetaRumah $petaRumah)
    {
        $petaRumah->delete();
        return redirect()->route('admin.peta-rumah.index')
            ->with('success', 'Data rumah dihapus!');
    }

    public function show(PetaRumah $petaRumah)
    {
        return redirect()->route('admin.peta-rumah.edit', $petaRumah);
    }

    /**
     * Return all active houses as JSON — used by Leaflet map
     */
    public function geojson()
    {
        $rumah = PetaRumah::where('aktif', true)->get();

        $features = $rumah->map(function ($r) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type'        => 'Point',
                    'coordinates' => [$r->lng, $r->lat],
                ],
                'properties' => [
                    'id'           => $r->id,
                    'no_rumah'     => $r->no_rumah,
                    'nama_kk'      => $r->nama_kk,
                    'alamat'       => $r->alamat,
                    'rt'           => $r->rt,
                    'rw'           => $r->rw,
                    'dusun'        => $r->dusun,
                    'jumlah_jiwa'  => $r->jumlah_jiwa,
                    'status_rumah' => $r->status_rumah,
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}
