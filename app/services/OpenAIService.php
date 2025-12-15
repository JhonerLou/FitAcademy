<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $apiKey = env('OPENAI_API_KEY');
        $this->client = OpenAI::client($apiKey);
    }

    public function chat(array $messages)
    {

        $systemMessage = [
            'role' => 'system',
            'content' => 'You are FitBot, an expert fitness assistant for FitAcademy. You help users with workout advice, nutrition tips, and navigating the FitAcademy platform. Keep your answers concise, encouraging, and science-based (Jeff Nippard style). If asked about medical advice, suggest seeing a professional.'
        ];

        array_unshift($messages, $systemMessage);

        $response = $this->client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens' => 300,
        ]);

        return $response->choices[0]->message->content;
    }
}
