<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        try {
            $users = User::all();

            if ($users->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No users found'], 404);
            }

            return response()->json(['success' => true, 'data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while fetching users'], 500);
        }
    }

    // Create a new user
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role'     => 'required|in:admin,user',
            ]);

            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data'    => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'User alredy exist'], 500);
        }
    }

    // Get a single user
    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while fetching the user'], 500);
        }
    }

    // Update a user
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $validated = $request->validate([
                'name'     => 'sometimes|string|max:255',
                'email'    => 'sometimes|email|unique:users,email,' . $id,
                'password' => 'sometimes|min:6',
                'role'     => 'sometimes|in:admin,user',
            ]);

            $user->update([
                'name'     => $validated['name'] ?? $user->name,
                'email'    => $validated['email'] ?? $user->email,
                'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
                'role'     => $validated['role'] ?? $user->role,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data'    => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the user'], 500);
        }
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the user'], 500);
        }
    }
}
