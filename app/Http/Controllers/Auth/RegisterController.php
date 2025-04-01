<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     */
    public function register(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[a-z]/',         // at least one lowercase letter
                'regex:/[A-Z]/',         // at least one uppercase letter
                'regex:/[0-9]/',         // at least one digit
                'regex:/[\W_]/',         // at least one special character (non-alphanumeric)
            ],
            'role' => 'required|in:user,admin',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.regex' => 'Password must be at least 6 characters long and include at least one uppercase letter, one special character, and one number.',
        ]);

        // Register the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Save the role
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect based on the user's role
        if ($user->role === 'admin') {
            return redirect()->route('admin.home')->with('success', 'Welcome, Admin!');
        } else {
            return redirect()->route('user.home')->with('success', 'Welcome, User!');
        }
    }
}
