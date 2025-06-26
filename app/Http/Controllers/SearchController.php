<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesjid;
use App\Models\Jemaah;
use App\Models\KegiatanDakwah;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $filters = $request->query('filter', []);

        $kecamatans = collect();
        $kelurahans = collect();
        $mesjids = collect();
        $jemaah = collect();
        $kegiatan = collect();

        if (empty($filters) || in_array('kecamatan', $filters)) {
            $kecamatans = Kecamatan::where('nama_kecamatan', 'like', "%$query%")->get();
        }
        if (empty($filters) || in_array('kelurahan', $filters)) {
            $kelurahans = Kelurahan::where('nama_kelurahan', 'like', "%$query%")->get();
        }
        if (empty($filters) || in_array('mesjid', $filters)) {
            $mesjids = Mesjid::where('nama', 'like', "%$query%")
                ->orWhere('alamat', 'like', "%$query%")
                ->get();
        }
        if (empty($filters) || in_array('jemaah', $filters)) {
            $jemaah = Jemaah::where('nama', 'like', "%$query%")
                ->orWhere('alamat', 'like', "%$query%")
                ->get();
        }
        if (empty($filters) || in_array('kegiatan', $filters)) {
            $kegiatan = KegiatanDakwah::where('judul', 'like', "%$query%")
                ->orWhere('deskripsi', 'like', "%$query%")
                ->get();
        }

        // Merge all results into a single collection
        $allResults = $kecamatans
            ->concat($kelurahans)
            ->concat($mesjids)
            ->concat($jemaah)
            ->concat($kegiatan);

        // Paginate manually
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $pagedResults = $allResults->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $results = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedResults,
            $allResults->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('user.result', compact('query', 'results'));
    }
}
