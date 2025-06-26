<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role; // Add this import
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'mesjid_id' => 'required|exists:mesjid,id',
        ], [
            'mesjid_id.required' => 'Silakan pilih mesjid dari daftar.',
            'mesjid_id.exists' => 'Mesjid yang dipilih tidak valid.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mesjid_id' => $request->mesjid_id,
        ]);

        // Create Jamaah profile for the user
        \App\Models\Jemaah::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'mesjid_id' => $request->mesjid_id,
            // Add other fields as needed, or leave null for user to fill later
        ]);

        // Assign the default role
        $user->assignRole('user'); // Replace 'user' with the default role you want

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
        // return redirect(route('dashboard', absolute: false));
    }
}
