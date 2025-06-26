<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Mesjid;
use App\Models\Jemaah;
use App\Models\KegiatanDakwah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $kecamatanCount = Kecamatan::count();
            $kelurahanCount = Kelurahan::count();
            $mesjidCount = Mesjid::count();
            $jemaahCount = Jemaah::count();

            // Fetch dakwah schedules with related mesjid data
            $dakwahSchedules = KegiatanDakwah::with('mesjid:id,nama_mesjid')->get();

            // Generate calendar days
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $startOfWeek = $startOfMonth->copy()->startOfWeek();
            $endOfWeek = $endOfMonth->copy()->endOfWeek();

            $calendarDays = [];
            $currentDate = $startOfWeek->copy();

            while ($currentDate <= $endOfWeek) {
                $week = [];
                for ($i = 0; $i < 7; $i++) {
                    $week[] = $currentDate->month === $startOfMonth->month ? $currentDate->day : null;
                    $currentDate->addDay();
                }
                $calendarDays[] = $week;
            }

            return view('admin.pages.dashboard', compact(
                'kecamatanCount',
                'kelurahanCount',
                'mesjidCount',
                'jemaahCount',
                'dakwahSchedules',
                'calendarDays'
            ));
        } elseif ($user->role === 'user') {
            return redirect()->route('user.home');
        }

        return redirect('/');
    }
}
