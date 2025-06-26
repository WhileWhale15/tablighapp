<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Jemaah;
use Illuminate\View\View;
use Illuminate\http\Request;

class JamaahController extends Controller
{
    public function index(Request $request)
    {
        $query = Jemaah::with('mesjid');

        if ($request->filled('mesjid_id')) {
            $query->where('mesjid_id', $request->mesjid_id);
        }
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $jamaah = $query->orderBy('nama', 'asc')->paginate(10);

        // For filter dropdowns
        $mesjids = \App\Models\Mesjid::orderBy('nama_mesjid')->get();

        return view('user.jemaah', compact('jamaah', 'mesjids'));
    }

    public function show($id)
    {
        $jamaah = Jemaah::with(['mesjid.kelurahan.kecamatan', 'pengalamanKhuruj'])->findOrFail($id);
        return view('user.jamaah-detail', compact('jamaah'));
    }
}
