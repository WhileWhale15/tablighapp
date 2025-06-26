<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanDakwah;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan = KegiatanDakwah::with(['mesjid'])->orderBy('tanggal', 'desc')->paginate(12);
        return view('user.schedule', compact('kegiatan'));
    }

    public function show($id)
    {
        $jadwal = KegiatanDakwah::with(['mesjid'])->findOrFail($id);
        return view('user.jadwal-detail', compact('jadwal'));
    }
}
