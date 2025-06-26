<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaah;

class JamaahController extends Controller
{
    public function index(Request $request)
    {
        $jamaah = Jemaah::with(['mesjid', 'kelurahan.kecamatan'])->paginate(12);
        return view('user.jemaah', compact('jamaah'));
    }

    public function show($id)
    {
        $jamaah = Jemaah::with(['mesjid', 'kelurahan.kecamatan', 'pengalamanKhuruj'])->findOrFail($id);
        return view('user.jamaah-detail', compact('jamaah'));
    }
}
