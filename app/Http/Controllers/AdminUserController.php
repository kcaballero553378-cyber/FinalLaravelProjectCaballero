<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST ALL USERS
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())  // exclude self
            ->orderBy('name')
            ->get();

        return view('admin.users', compact('users'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ROLE
    |--------------------------------------------------------------------------
    */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:guest,researcher,reviewer,admin',
        ]);

        $user = User::findOrFail($id);

        // Prevent admin from demoting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', $user->name . '\'s role updated to ' . $request->role);
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', $user->name . ' has been deleted.');
    }
}