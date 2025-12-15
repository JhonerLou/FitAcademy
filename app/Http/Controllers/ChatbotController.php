<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }


    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'array'
        ]);

        $userMessage = $request->input('message');

        $messages = $request->input('history', []);
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $botReply = $this->openAIService->chat($messages);

            return response()->json([
                'reply' => $botReply,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'reply' => 'Sorry, I am having trouble connecting to my brain right now. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
