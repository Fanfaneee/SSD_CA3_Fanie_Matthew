<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Edit User
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
    }

    // Delete User
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }

    // Make User Admin
    public function makeAdmin(User $user)
    {
        $user->update(['is_admin' => 1]);

        return redirect()->route('admin.dashboard')->with('success', 'User promoted to admin!');
    }

    public function demoteAdmin(User $user)
{
    // Ensure the user is currently an admin
    if (!$user->is_admin) {
        return redirect()->back()->with('error', 'This user is not an admin.');
    }

    $user->update(['is_admin' => 0]);

    return redirect()->route('admin.dashboard')->with('success', 'User demoted from admin successfully!');
}
}