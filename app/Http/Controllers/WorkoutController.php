<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    protected $geminiAIService;

    public function __construct(GeminiService $geminiAIService)
    {
        $this->geminiAIService = $geminiAIService;
    }

    public function index()
    {
        $workouts = Workout::all();
        return view('admin.workouts.index', compact('workouts'));
    }

    public function create()
    {
        return view('admin.workouts.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'intensity' => 'required|in:Easy,Moderate,Hard,Beast Mode',
            'equipment' => 'nullable|string|max:255',
            'muscle_groups' => 'required|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // 2. Handle the file upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('workouts', 'public');
        }

        // 3. Create the workout
        Workout::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'intensity' => $request->intensity,
            'equipment' => $request->equipment,
            'muscle_groups' => $request->muscle_groups,
            'instructions' => $request->instructions,
            'image' => $imagePath,
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Workout created successfully!');
    }

    public function createdWorkouts()
    {
        $workouts = Workout::all();
        return view('dashboard.admin', compact('workouts'));
    }

    public function generate(Request $request)
    {
        $preferences = $request->validate([
            'goal' => 'required|string',
            'duration' => 'required|integer',
            'intensity' => 'required|string',
        ]);

        try {
            $workout = $this->geminiAIService->generateWorkout($preferences);
            return response()->json($workout);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function listWorkouts()
    {
        $workouts = Workout::all();
        return view('user.display-workout', compact('workouts'));
    }
}
