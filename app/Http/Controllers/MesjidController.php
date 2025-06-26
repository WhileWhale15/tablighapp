<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesjid;
use App\Models\Kelurahan;
use App\Models\Jemaah;
use App\Models\KegiatanDakwah;

class MesjidController extends Controller
{
    public function index(Request $request)
    {
        $kelurahan_id = $request->query('kelurahan_id');

        if (!$kelurahan_id) {
            return redirect()->route('kelurahan.index')->with('error', 'Kelurahan ID is required.');
        }

        $kelurahan = Kelurahan::findOrFail($kelurahan_id);
        $mesjids = Mesjid::where('kelurahan_id', $kelurahan_id)
            ->withCount('jemaah')  // This will add jemaah_count
            ->orderBy('nama_mesjid', 'asc')->paginate(10);

        return view('admin.pages.mesjid', compact('kelurahan', 'mesjids'));
    }

    public function show($mesjidId)
    {
        $mesjid = Mesjid::findOrFail($mesjidId);

        $kegiatanDakwah = KegiatanDakwah::where('mesjid_id', $mesjidId)->orderBy('tanggal', 'desc')->get();

        $jemaahs = Jemaah::where('mesjid_id', $mesjidId)->paginate(10);

        $notes = \App\Models\ResidentNote::where('mesjid_id', $mesjidId)->get();

        return view('admin.pages.jemaah', compact('mesjid', 'kegiatanDakwah', 'jemaahs', 'notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mesjid' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kelurahan_id' => 'required|exists:kelurahan,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ]);

        // Check for duplicate data
        $duplicate = Mesjid::where('nama_mesjid', $request->nama_mesjid)
            ->where('kelurahan_id', $request->kelurahan_id)
            ->first();

        if ($duplicate) {
            return response()->json([
                'success' => false,
                'duplicate' => true,
                'data' => $duplicate,
                'message' => 'Data dengan nama yang sama sudah ada di wilayah ini.',
            ]);
        }

        // Create new Mesjid
        $mesjid = Mesjid::create([
            'nama_mesjid' => $request->nama_mesjid,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mesjid berhasil ditambahkan!',
            'data' => $mesjid,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mesjid' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|regex:/^-?\d{1,3}\.\d+,-?\d{1,3}\.\d+$/',
        ]);

        $mesjid = Mesjid::findOrFail($id);
        $mesjid->update([
            'nama_mesjid' => $request->nama_mesjid,
            'alamat' => $request->alamat,
            'koordinat' => $request->koordinat,
        ]);

        return response()->json(['success' => true, 'message' => 'Mesjid berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $mesjid = Mesjid::findOrFail($id);
        $mesjid->delete();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Mesjid berhasil dihapus.']);
    }

    /**
     * Search mesjid for autocomplete
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $results = Mesjid::where('nama_mesjid', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'nama_mesjid']);
        return response()->json($results);
    }
}
