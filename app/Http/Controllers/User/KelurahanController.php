<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelurahan;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        $kelurahan = Kelurahan::with('kecamatan')->paginate(12);
        return view('user.kelurahan', compact('kelurahan'));
    }

    public function show($id)
    {
        $kelurahan = Kelurahan::with(['kecamatan', 'mesjid'])->findOrFail($id);
        return view('user.kelurahan-detail', compact('kelurahan'));
    }
}
