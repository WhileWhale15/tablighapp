<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mesjid;

class MesjidController extends Controller
{
    public function show(Mesjid $mesjid)
    {
        return view('user.mesjid-show', compact('mesjid'));
    }
}
