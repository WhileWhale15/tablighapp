<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles'); // Include roles to avoid N+1 queries

        // Check if search query exists
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }

        $users = $query->paginate(10)->appends(['search' => $request->input('search')]);

        // Update the view path to 'admin.users'
        return view('admin.pages.users', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name', // Validate against roles in the database
        ]);

        $user = User::findOrFail($id);

        // Use Spatie's syncRoles method to update the user's role
        $user->syncRoles([$request->role]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Remove roles before deleting the user
        $user->syncRoles([]);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
