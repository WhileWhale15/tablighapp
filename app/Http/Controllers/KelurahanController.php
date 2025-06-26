<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;
use App\Models\Kecamatan;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        $kecamatan_id = $request->query('kecamatan_id');

        if (!$kecamatan_id) {
            return redirect()->route('data.index')->with('error', 'Kecamatan ID is required.');
        }

        $kecamatan = Kecamatan::findOrFail($kecamatan_id);
        $kelurahans = Kelurahan::withCount('mesjids')
            ->where('kecamatan_id', $kecamatan_id)
            ->orderBy('nama_kelurahan', 'asc')
            ->paginate(10);

        return view('admin.pages.kelurahan', compact('kecamatan', 'kelurahans'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama_kelurahan' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ]);

        // Create a new Kelurahan
        $kelurahan = new Kelurahan();
        $kelurahan->nama_kelurahan = $request->input('nama_kelurahan');
        $kelurahan->kecamatan_id = $request->input('kecamatan_id');
        $kelurahan->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Kelurahan berhasil ditambahkan.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelurahan' => 'required|string|max:255|unique:kelurahan,nama_kelurahan,' . $id,
        ]);

        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->save();

        return response()->json(['success' => true, 'message' => 'Kelurahan berhasil diupdate!']);
    }

    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->delete();

        return response()->json(['success' => true, 'message' => 'Kelurahan berhasil dihapus.']);
    }
}
