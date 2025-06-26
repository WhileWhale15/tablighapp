<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    public function show(Kecamatan $kecamatan)
    {
        $kecamatan->load('kelurahans');
        return view('user.kecamatan-show', compact('kecamatan'));
    }
}
