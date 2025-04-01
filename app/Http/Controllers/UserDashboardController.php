<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use Illuminate\Support\Facades\Auth;


class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workoutCount = Workout::where('user_id', $user->id)->count();

        return view('dashboard.user', compact('workoutCount'));
    }
}
