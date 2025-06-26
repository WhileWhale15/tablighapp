<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MesjidController;
use App\Http\Controllers\JemaahController as AdminJemaahController;
use App\Http\Controllers\KegiatanDakwahController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ResidentNoteController;
use App\Http\Controllers\Website\JamaahController;
use App\Http\Controllers\Website\MasjidController;
use App\Http\Controllers\Website\JadwalController;

// Route List
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Kecamatan Management
        Route::prefix('data')->name('data.')->group(function () {
            Route::get('/', [KecamatanController::class, 'index'])->name('index');
            Route::post('/', [KecamatanController::class, 'store'])->name('store');
            Route::put('/{id}', [KecamatanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KecamatanController::class, 'destroy'])->name('destroy');
        });

        // Kelurahan Management
        Route::prefix('kelurahan')->name('kelurahan.')->group(function () {
            Route::get('/', [KelurahanController::class, 'index'])->name('index');
            Route::post('/', [KelurahanController::class, 'store'])->name('store');
            Route::put('/{id}', [KelurahanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KelurahanController::class, 'destroy'])->name('destroy');
        });

        // Mesjid Management
        Route::prefix('mesjid')->name('mesjid.')->group(function () {
            Route::get('/', [MesjidController::class, 'index'])->name('index');
            Route::post('/', [MesjidController::class, 'store'])->name('store');
            Route::put('/{id}', [MesjidController::class, 'update'])->name('update');
            Route::delete('/{id}', [MesjidController::class, 'destroy'])->name('destroy');
        });

        // Jemaah Management (Admin)
        Route::prefix('jemaah')->name('jemaah.')->group(function () {
            Route::get('/{mesjid_id}', [AdminJemaahController::class, 'index'])->name('index');
            Route::post('/', [AdminJemaahController::class, 'store'])->name('store');
            Route::put('/{id}', [AdminJemaahController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminJemaahController::class, 'destroy'])->name('destroy');
        });

        // Kegiatan Dakwah Management
        Route::prefix('kegiatan-dakwah')->name('kegiatan-dakwah.')->group(function () {
            Route::post('/', [KegiatanDakwahController::class, 'store'])->name('store');
            Route::get('/{id}', [KegiatanDakwahController::class, 'show'])->name('show');
            Route::put('/{id}', [KegiatanDakwahController::class, 'update'])->name('update');
            Route::delete('/{id}', [KegiatanDakwahController::class, 'destroy'])->name('destroy');
        });

        // Resident Notes Management
        Route::prefix('resident-notes')->name('resident-notes.')->group(function () {
            Route::get('/', [ResidentNoteController::class, 'index'])->name('index');
            Route::get('/create', [ResidentNoteController::class, 'create'])->name('create');
            Route::post('/', [ResidentNoteController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ResidentNoteController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ResidentNoteController::class, 'update'])->name('update');
            Route::delete('/{id}', [ResidentNoteController::class, 'destroy'])->name('destroy');
        });

        // Profile Routes for Admin Panel (edit.blade.php)
        Route::prefix('admin-profile')->name('admin-profile.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
            Route::delete('/', [\App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('destroy');
        });

        // Dokumentasi Admin Panel
        Route::get('/dokumentasi', function () {
            return view('admin.pages.documentation');
        })->name('admin.documentation');
    });


    // User Routes (for both admin and user role)
    Route::middleware(['role:user|admin'])->group(function () {
        Route::get('/', function () {
            return view('user.home');
        })->name('user.home');

        // Search
        Route::get('/search', [SearchController::class, 'index'])->name('search.results');

        // Profile Routes for Website Side (profile.blade.php) accessible by both user and admin
        Route::prefix('user-profile')->name('user-profile.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\ProfileController::class, 'show'])->name('show');
            Route::patch('/', [\App\Http\Controllers\User\ProfileController::class, 'updateProfile'])->name('updateProfile');
            Route::delete('/', [\App\Http\Controllers\User\ProfileController::class, 'destroy'])->name('destroy');
        });

        // Jamaah profile settings (user)
        Route::middleware(['auth'])->group(function () {
            Route::get('/profile/settings', [\App\Http\Controllers\User\ProfileController::class, 'editJamaah'])->name('user.profile.settings');
            Route::post('/profile/settings', [\App\Http\Controllers\User\ProfileController::class, 'updateJamaah'])->name('user.profile.settings.update');
        });

        // Direktori Kelurahan (user)
        Route::get('/direktori/kelurahan', [\App\Http\Controllers\Website\KelurahanController::class, 'index'])->name('user.kelurahan');

        // Direktori Masjid (user)
        Route::get('/direktori/masjid', [MasjidController::class, 'index'])->name('user.mesjid');

        // Direktori Jamaah (user)
        Route::get('/direktori/jamaah', [JamaahController::class, 'index'])->name('user.jemaah');

        // Direktori Kegiatan Dakwah (user)
        Route::get('/direktori/kegiatan-dakwah', [\App\Http\Controllers\Website\KegiatanDakwahController::class, 'index'])->name('user.kegiatan-dakwah');

        // Tentang Page (user)
        Route::get('/tentang', [\App\Http\Controllers\Website\TentangController::class, 'index'])->name('user.about');

        // Jadwal Page (user)
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('user.schedule');

        // Jamaah Detail (user)
        Route::get('/direktori/jamaah/{id}', [JamaahController::class, 'show'])->name('user.jamaah.detail');

        // Masjid Detail (user)
        Route::get('/direktori/masjid/{id}', [MasjidController::class, 'show'])->name('user.masjid.detail');

        // Kelurahan Detail (user)
        Route::get('/direktori/kelurahan/{id}', [\App\Http\Controllers\Website\KelurahanController::class, 'show'])->name('user.kelurahan.detail');

        // Kegiatan Dakwah Detail (user)
        Route::get('/kegiatan/{id}', [JadwalController::class, 'show'])->name('user.kegiatan.detail');

        // Direktori Main Page (user)
        Route::get('/direktori', function () {
            return view('user.direktori');
        })->name('user.direktori');
    });

    // User Detail Pages (for search result links)
    Route::middleware(['role:user|admin'])->group(function () {
        Route::get('/kecamatan/{id}', [\App\Http\Controllers\User\KecamatanController::class, 'show'])->name('user.kecamatan.show');
        Route::get('/kegiatan-dakwah/{id}', [\App\Http\Controllers\User\KegiatanDakwahController::class, 'show'])->name('user.kegiatan-dakwah.show');
    });
});

// Route for Mesjid autocomplete search
Route::get('/api/mesjid-search', [App\Http\Controllers\MesjidController::class, 'search'])->name('mesjid.search');

// Public route for Mesjid search without auth
Route::get('/mesjid-search', function (\Illuminate\Http\Request $request) {
    $q = $request->query('q');
    if (!$q)
        return response()->json([]);
    $mesjids = \App\Models\Mesjid::with(['kelurahan.kecamatan'])
        ->where('nama_mesjid', 'like', "%$q%")
        ->limit(10)
        ->get();
    $results = $mesjids->map(function ($m) {
        return [
            'id' => $m->id,
            'nama_mesjid' => $m->nama_mesjid,
            'kelurahan' => $m->kelurahan->nama_kelurahan ?? '-',
            'kecamatan' => $m->kelurahan->kecamatan->nama_kecamatan ?? '-',
            'label' => $m->nama_mesjid . ' • ' . ($m->kelurahan->nama_kelurahan ?? '-') . ', ' . ($m->kelurahan->kecamatan->nama_kecamatan ?? '-')
        ];
    });
    return response()->json($results);
});

// AJAX route for Mesjid search (autocomplete)
Route::get('/ajax/mesjid-search', [App\Http\Controllers\User\ProfileController::class, 'ajaxMesjidSearch'])->name('ajax.mesjid.search');

require __DIR__ . '/auth.php';
