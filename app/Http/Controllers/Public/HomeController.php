<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mesjid;
use App\Models\KegiatanDakwah;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $mesjids = Mesjid::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(6);

        $kegiatans = KegiatanDakwah::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(6);

        return view('user.home', compact('mesjids', 'kegiatans', 'search'));
    }
}
