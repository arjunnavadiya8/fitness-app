<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the edit profile form.
     */
    public function edit()
    {
        // Pass the authenticated user's data to the view
        return view('user.edit-profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Handle the profile update.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'age' => 'nullable|integer|min:0|max:150',
            'gender' => 'nullable|in:male,female,other',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete the old profile photo if it exists
            if ($user->profile_photo_url) {
                Storage::delete($user->profile_photo_url);
            }

            // Store the new profile photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo_url'] = $path;
        }

        // Update the user's profile
        $user->update($validatedData);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
