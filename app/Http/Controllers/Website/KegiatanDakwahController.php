<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\KegiatanDakwah;
use Illuminate\Http\Request;

class KegiatanDakwahController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanDakwah::with('mesjid');
        // Optional: add search/filter logic here
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('judul', 'like', "%$q%")
                ->orWhere('deskripsi', 'like', "%$q%")
                ->orWhereHas('mesjid', function ($sub) use ($q) {
                    $sub->where('nama', 'like', "%$q%")
                        ->orWhere('alamat', 'like', "%$q%")
                        ->orWhere('kecamatan', 'like', "%$q%")
                        ->orWhere('kelurahan', 'like', "%$q%");
                });
        }
        $kegiatan = $query->orderBy('tanggal', 'desc')->paginate(10);
        return view('user.kegiatan-dakwah', compact('kegiatan'));
    }
}
