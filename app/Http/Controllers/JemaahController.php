<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jemaah;
use App\Models\Mesjid;
use App\Models\PengalamanKhuruj;

class JemaahController extends Controller
{
    public function index(Request $request, $mesjid_id = null)
    {
        if (!$mesjid_id) {
            return redirect()->route('mesjid.index');
        }

        $mesjid = Mesjid::findOrFail($mesjid_id);
        $jemaahs = Jemaah::where('mesjid_id', $mesjid_id)->orderBy('nama_jemaah', 'asc')->with('pengalamanKhuruj')->paginate(10);

        $notes = \App\Models\ResidentNote::where('mesjid_id', $mesjid_id)->get();

        return view('admin.pages.jemaah', compact('mesjid', 'jemaahs', 'notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:jemaah,no_ktp',
            'mesjid_id' => 'required|exists:mesjid,id',
            'pengalaman_khuruj' => 'required|string',
        ]);

        $jemaah = new Jemaah();
        $jemaah->nama = $request->input('nama');
        $jemaah->no_ktp = $request->input('no_ktp');
        $jemaah->mesjid_id = $request->input('mesjid_id');
        $jemaah->save();

        $pengalamanKhuruj = new PengalamanKhuruj();
        $pengalamanKhuruj->jemaah_id = $jemaah->id;
        $pengalamanKhuruj->jenis_pengalaman = $request->input('pengalaman_khuruj');
        $pengalamanKhuruj->save();

        return response()->json(['success' => true, 'message' => 'Jemaah berhasil ditambahkan.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:jemaah,no_ktp,' . $id,
            'pengalaman_khuruj' => 'required|string',
        ]);

        $jemaah = Jemaah::findOrFail($id);
        $jemaah->nama = $request->input('nama');
        $jemaah->no_ktp = $request->input('no_ktp');
        $jemaah->save();

        $pengalamanKhuruj = PengalamanKhuruj::where('jemaah_id', $jemaah->id)->first();
        if ($pengalamanKhuruj) {
            $pengalamanKhuruj->jenis_pengalaman = $request->input('pengalaman_khuruj');
            $pengalamanKhuruj->save();
        } else {
            $pengalamanKhuruj = new PengalamanKhuruj();
            $pengalamanKhuruj->jemaah_id = $jemaah->id;
            $pengalamanKhuruj->jenis_pengalaman = $request->input('pengalaman_khuruj');
            $pengalamanKhuruj->save();
        }

        return response()->json(['success' => true, 'message' => 'Jemaah berhasil diupdate.']);
    }

    public function destroy($id)
    {
        $jemaah = Jemaah::findOrFail($id);
        $jemaah->delete();

        return response()->json(['success' => true, 'message' => 'Jemaah berhasil dihapus.']);
    }
}
