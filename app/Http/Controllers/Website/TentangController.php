<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TentangController extends Controller
{
    public function index(): View
    {
        return view('user.about');
    }
}
