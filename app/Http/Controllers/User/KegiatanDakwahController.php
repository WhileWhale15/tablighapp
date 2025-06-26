<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KegiatanDakwah;

class KegiatanDakwahController extends Controller
{
    public function show(KegiatanDakwah $kegiatanDakwah)
    {
        return view('user.kegiatan-dakwah-show', compact('kegiatanDakwah'));
    }
}
