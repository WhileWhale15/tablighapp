<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mesjid;
use App\Models\Kelurahan;
use App\Models\Kecamatan;

Route::get('/mesjid-search', function (Request $request) {
    $q = $request->query('q');
    if (!$q)
        return response()->json([]);
    $mesjids = Mesjid::with(['kelurahan.kecamatan'])
        ->where('nama_mesjid', 'like', "%$q%")
        ->limit(10)
        ->get();
    $results = $mesjids->map(function ($m) {
        return [
            'id' => $m->id,
            'nama_mesjid' => $m->nama_mesjid,
            'kelurahan' => $m->kelurahan->nama_kelurahan ?? '-',
            'kecamatan' => $m->kelurahan->kecamatan->nama_kecamatan ?? '-',
            'label' => $m->nama_mesjid . ' - ' . ($m->kelurahan->nama_kelurahan ?? '-') . ', ' . ($m->kelurahan->kecamatan->nama_kecamatan ?? '-')
        ];
    });
    return response()->json($results);
});
