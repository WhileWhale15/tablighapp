<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::withCount('kelurahans', 'mesjids')->orderBy('nama_kecamatan')->paginate(10);

        return view('admin.pages.data', compact('kecamatans'));
    }


    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Save to database
        $kecamatan = new Kecamatan();
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->save();

        return redirect()->route('data.index')->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::find($id);

        if (!$kecamatan) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        $kecamatan->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Find the Kecamatan by ID and update it
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->nama_kecamatan = $request->input('nama_kecamatan');
        $kecamatan->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate!']);
    }

    public function list()
    {
        // Eager load mesjids and jemaahs count through relationships
        $kecamatans = Kecamatan::with('mesjids.jemaah')
            ->withCount('mesjids')
            ->get();

        // Manually compute jemaah count per kecamatan
        foreach ($kecamatans as $kecamatan) {
            $kecamatan->jemaah_count = $kecamatan->mesjids->sum(function ($mesjid) {
                return $mesjid->jemaah->count();
            });
        }

        return view('user.home', compact('kecamatans'));
    }

}
