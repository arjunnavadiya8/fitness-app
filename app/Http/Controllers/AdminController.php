<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout; // Import the Workout model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $workouts = Workout::all();

        return view('dashboard.admin', compact('workouts'));
    }

    public function manageUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('role', 'user')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('role', 'like', "%$search%");
            })
            ->get();

        return view('admin.manage-users', compact('users', 'search'));
    }

    public function editUser($id)
    {
        //get user by id
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.manage-users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage-users')->with('success', 'User deleted successfully.');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
