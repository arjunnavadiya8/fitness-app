<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class GeminiAIService
{
    protected $apiKey;
    protected $baseUrl = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent";

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateWorkout($userData)
    {
        try {
            $url = $this->baseUrl . "?key=" . $this->apiKey;

            $prompt = $this->buildWorkoutPrompt($userData);

            $response = Http::post($url, [
                "contents" => [
                    ["parts" => [["text" => $prompt]]]
                ],
                "generationConfig" => [
                    "temperature" => 0.7,
                    "topK" => 40,
                    "topP" => 0.95,
                    "maxOutputTokens" => 100,
                ]
            ]);

            if (!$response->successful()) {
                throw new RequestException($response);
            }

            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'Failed to generate workout plan: ' . $e->getMessage()
            ];
        }
    }

    protected function buildWorkoutPrompt($userData)
    {
        return
            <<<PROMPT
Create a detailed workout plan with the following requirements:

User Details:
- Age: {$userData['age']}
- Fitness Level: {$userData['fitness_level']}
- Goals: {$userData['goals']}
- Available Equipment: {$userData['equipment']}

Please provide:
1. Warm-up exercises
2. Main workout routine with sets and reps
3. Cool-down stretches
4. Estimated duration
5. Safety precautions

Format the response in a clear, structured way.
PROMPT;
    }
}
