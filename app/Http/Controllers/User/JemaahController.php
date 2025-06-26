<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jemaah;

class JemaahController extends Controller
{
    public function show(Jemaah $jemaah)
    {
        $jemaah->load('mesjid');
        return view('user.jemaah-show', compact('jemaah'));
    }
}
