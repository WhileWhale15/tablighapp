<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Mesjid;
use App\Models\Kecamatan;
use Illuminate\View\View;

class MasjidController extends Controller
{
    public function index(): View
    {
        $masjid = Mesjid::with(['kelurahan.kecamatan'])->paginate(10);
        $kecamatans = Kecamatan::all();
        return view('user.mesjid', compact('masjid', 'kecamatans'));
    }

    public function show($id)
    {
        $masjid = Mesjid::with(['kelurahan.kecamatan', 'jemaah'])->findOrFail($id);
        return view('user.mesjid-show', compact('masjid'));
    }
}
