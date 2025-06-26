<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Kelurahan;

class KelurahanController extends Controller
{
    public function index(): View
    {
        $kelurahan = Kelurahan::with('kecamatan')
            ->orderBy('nama_kelurahan', 'asc')
            ->paginate(10);
        return view('user.kelurahan', compact('kelurahan'));
    }

    public function show($id): View
    {
        $kelurahan = Kelurahan::with([
            'kecamatan',
            'mesjids' => function ($query) {
                $query->orderBy('nama_mesjid', 'asc');
            }
        ])->findOrFail($id);
        return view('user.kelurahan-detail', compact('kelurahan'));
    }
}
