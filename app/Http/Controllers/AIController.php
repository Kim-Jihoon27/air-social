<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    private function getApiKey()
    {
        return config('ai.gemini_api_key', '');
    }

    public function improveWriting(Request $request)
    {
        $message = $request->input('message');
        $apiKey = $this->getApiKey();

        if (! $apiKey) {
            return response()->json(['error' => 'AI API key not configured'], 500);
        }

        if (! $message) {
            return response()->json(['error' => 'Message is required'], 400);
        }

        $prompt = "Improve the following writing while keeping the original idea and meaning intact. Make it more polished, clear, and well-written. Return only the improved text without any explanation:\n\n".$message;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $apiKey,
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent', [
                'contents' => [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ]);

            $result = $response->json();

            if ($response->status() === 429) {
                return response()->json(['error' => 'AI service is temporarily unavailable due to rate limit. Please wait a moment and try again.'], 429);
            }

            if (isset($result['error'])) {
                return response()->json(['error' => $result['error']['message'] ?? 'AI service error'], 500);
            }

            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json([
                    'improved' => $result['candidates'][0]['content']['parts'][0]['text'],
                ]);
            }

            return response()->json(['error' => 'No response from AI. Please try again.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to connect to AI service. Please try again.'], 500);
        }
    }
}
