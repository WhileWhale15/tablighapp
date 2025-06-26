<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form for website side.
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        // Always eager load jemaah and its mesjid, kelurahan, kecamatan
        $user->load(['jemaah.mesjid.kelurahan.kecamatan']);
        $jemaah = $user->jemaah;
        // If the user does not have a Jemaah profile, create one automatically
        if (!$jemaah) {
            $mesjidId = $user->mesjid_id ?? (\App\Models\Mesjid::first()?->id);
            $jemaah = \App\Models\Jemaah::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $user->name,
                    'mesjid_id' => $mesjidId,
                    'no_ktp' => '',
                ]
            );
            // Eager load after creation
            $jemaah->load('mesjid.kelurahan.kecamatan');
        }
        $mesjids = \App\Models\Mesjid::with(['kelurahan.kecamatan'])
            ->orderBy('nama_mesjid')
            ->get(['id', 'nama_mesjid', 'kelurahan_id']);
        $mesjids = $mesjids->map(function ($m) {
            return [
                'id' => $m->id,
                'nama_mesjid' => $m->nama_mesjid,
                'kelurahan' => optional($m->kelurahan)->nama_kelurahan ?? '',
                'kecamatan' => optional(optional($m->kelurahan)->kecamatan)->nama_kecamatan ?? '',
            ];
        })->values();
        return view('user.profile', [
            'user' => $user,
            'jemaah' => $jemaah,
            'mesjids' => $mesjids,
        ]);
    }

    /**
     * Update the user's profile information for website side.
     */
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        return Redirect::route('user-profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account for website side.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    public function editJamaah()
    {
        $user = auth()->user();
        $jemaah = $user->jemaah;
        return view('user.profile-settings', compact('user', 'jemaah'));
    }

    public function updateJamaah(Request $request)
    {
        $user = auth()->user();
        $jemaah = $user->jemaah;
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'nullable|string|max:32',
            'no_telepon' => 'nullable|string|max:32',
            'jenis_kelamin' => 'nullable|string|max:16',
            'alamat' => 'nullable|string|max:255',
            'mesjid_id' => 'nullable|exists:mesjid,id',
        ]);
        $jemaah->update($request->only(['nama', 'no_ktp', 'no_telepon', 'jenis_kelamin', 'alamat', 'mesjid_id']));
        return redirect()->back()->with('success', 'Profil Jemaah berhasil diperbarui.');
    }

    /**
     * AJAX search for mesjids (for autocomplete)
     */
    public function ajaxMesjidSearch(Request $request)
    {
        $q = $request->input('q', '');
        $mesjids = \App\Models\Mesjid::with(['kelurahan.kecamatan'])
            ->where('nama_mesjid', 'like', "%{$q}%")
            ->orWhereHas('kelurahan', function ($query) use ($q) {
                $query->where('nama_kelurahan', 'like', "%{$q}%");
            })
            ->orWhereHas('kelurahan.kecamatan', function ($query) use ($q) {
                $query->where('nama_kecamatan', 'like', "%{$q}%");
            })
            ->orderBy('nama_mesjid')
            ->limit(10)
            ->get();

        $results = $mesjids->map(function ($m) {
            return [
                'id' => $m->id,
                'nama_mesjid' => $m->nama_mesjid,
                'kelurahan' => optional($m->kelurahan)->nama_kelurahan ?? '',
                'kecamatan' => optional(optional($m->kelurahan)->kecamatan)->nama_kecamatan ?? '',
            ];
        })->values();

        return response()->json($results);
    }
}
