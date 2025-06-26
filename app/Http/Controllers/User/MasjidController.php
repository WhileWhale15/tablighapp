<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mesjid;

class MasjidController extends Controller
{
    public function index(Request $request)
    {
        $mesjid = Mesjid::with(['kelurahan.kecamatan'])->paginate(12);
        return view('user.mesjid', compact('mesjid'));
    }

    public function show($id)
    {
        $masjid = Mesjid::with(['kelurahan.kecamatan', 'kegiatan', 'jamaah'])->findOrFail($id);
        return view('user.masjid-detail', compact('masjid'));
    }
}
