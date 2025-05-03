<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WorkoutGenerateController extends Controller
{
    // Constants for API configuration
    private const GEMINI_API_URL = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro-002:generateContent';
    private const DEFAULT_WORKOUT = [
        'Default Section' => [
            [
                'name' => 'Default Exercise 1',
                'sets' => '3',
                'reps' => '15',
                'description' => 'Sample exercise description'
            ],
            [
                'name' => 'Default Exercise 2',
                'sets' => '3',
                'reps' => '10',
                'description' => 'Sample exercise description'
            ]
        ]
    ];

    /**
     * Show the workout generation form
     */
    public function showGenerateForm()
    {
        return view('workouts.generate');
    }

    /**
     * Generate a workout based on user input
     */
    public function generateWorkout(Request $request)
    {
        $validated = $request->validate([
            'goal' => 'required|string|max:255',
            'fitness_level' => 'required|string|in:beginner,intermediate,advanced',
            'duration' => 'required|integer|min:10|max:120',
        ]);

        try {
            $workoutText = $this->callGeminiAI(
                $validated['goal'],
                $validated['fitness_level'],
                $validated['duration']
            );

            if (!$workoutText) {
                throw new \Exception('Failed to generate workout content');
            }

            $exercises = $this->extractExercises($workoutText) ?? self::DEFAULT_WORKOUT;

            session()->flash('generatedWorkout', [
                'goal' => $validated['goal'],
                'fitness_level' => $validated['fitness_level'],
                'duration' => $validated['duration'],
                'exercises' => $exercises,
                'generated_at' => now()->toDateTimeString()
            ]);

            return redirect()->route('generated-workout');

        } catch (\Exception $e) {
            Log::error('Workout generation failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Workout generation failed. Please try again.');
        }
    }

    /**
     * Display the generated workout
     */
    public function showGeneratedWorkout()
    {
        $workout = session('generatedWorkout');

        if (empty($workout)) {
            return redirect()
                ->route('generate-workout.form')
                ->with('info', 'Please generate a workout first');
        }

        return view('workouts.generated', [
            'workout' => $workout,
            'sections' => array_keys($workout['exercises'])
        ]);
    }

    /**
     * Call Gemini AI API to generate workout content
     */
    private function callGeminiAI(string $goal, string $fitnessLevel, int $duration): ?string
    {
        $apiKey = config('services.gemini.key'); // Better configuration approach

        if (empty($apiKey)) {
            Log::error('Gemini API key not configured');
            return null;
        }

        try {
            $prompt = $this->buildPrompt($goal, $fitnessLevel, $duration);

            $response = Http::timeout(30) // Add timeout
                ->retry(3, 500) // Add retry mechanism
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post(self::GEMINI_API_URL . '?key=' . $apiKey, [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topP' => 0.9,
                        'maxOutputTokens' => 2000
                    ]
                ]);

            if ($response->failed()) {
                throw new \Exception('API request failed: ' . $response->status());
            }

            $data = $response->json();

            return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        } catch (\Exception $e) {
            Log::error('Gemini API call failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Build the prompt for Gemini AI
     */
    private function buildPrompt(string $goal, string $fitnessLevel, int $duration): string
    {
        return sprintf(
            "Generate a detailed %d-minute workout plan for a %s level person with the goal of %s. " .
            "Format the response with clear sections (like Warm-up, Main Workout, Cool-down) " .
            "marked with # at the beginning. For each exercise, wrap the name in double asterisks " .
            "and include the description in parentheses. Example:\n\n" .
            "# Warm-up (5 minutes):\n" .
            "**Exercise 1** (Description of how to perform)\n" .
            "**Exercise 2** (Description of how to perform)\n\n" .
            "Include appropriate duration or reps/sets where applicable.",
            $duration,
            $fitnessLevel,
            $goal
        );
    }

    /**
     * Extract exercises from the generated text
     */
    private function extractExercises(string $text): array
    {
        $sections = [];
        $currentSection = null;
        $lines = preg_split('/\r\n|\n|\r/', $text); // Handle different line endings

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line)) continue;

            // Section detection (starts with #)
            if (preg_match('/^#\s*(.+?)(?:\s*\((\d+)\s*minutes?\))?:?$/i', $line, $sectionMatches)) {
                $currentSection = trim($sectionMatches[1]);
                $sections[$currentSection] = [];
                continue;
            }

            // Exercise detection (wrapped in **)
            if ($currentSection && preg_match('/^\*\*(.+?)\*\*(?:\s*\((.*?)\))?$/', $line, $exerciseMatches)) {
                $exercise = [
                    'name' => trim($exerciseMatches[1]),
                    'sets' => 'N/A',
                    'reps' => 'N/A',
                    'description' => $exerciseMatches[2] ?? '',
                ];

                // Extract sets and reps if mentioned in description
                if (preg_match('/(\d+)\s*sets?.*?(\d+)\s*reps?/i', $exercise['description'], $setsReps)) {
                    $exercise['sets'] = $setsReps[1];
                    $exercise['reps'] = $setsReps[2];
                }

                $sections[$currentSection][] = $exercise;
            }
        }

        return !empty($sections) ? $sections : self::DEFAULT_WORKOUT;
    }
}
