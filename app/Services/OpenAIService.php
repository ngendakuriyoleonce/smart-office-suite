<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    protected ?string $apiKey;

    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->model = config('services.openai.model', 'gpt-4o-mini');
    }

    protected function client(): ?\OpenAI\Client
    {
        if (! $this->apiKey) {
            return null;
        }
        return OpenAI::client($this->apiKey);
    }

    public function summarizeVisit(string $notes): ?string
    {
        $client = $this->client();
        if (! $client) {
            return null;
        }

        $response = $client->chat()->create([
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => 'Summarize this visitor note in one sentence.'],
                ['role' => 'user', 'content' => $notes],
            ],
        ]);

        return $response->choices[0]->message->content;
    }

    public function generateBadgeImage(string $fullName, string $company): ?string
    {
        $client = $this->client();
        if (! $client) {
            return null;
        }

        $response = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => "Professional visitor badge for {$fullName} from {$company}. Clean design with name, company, date, and a modern corporate style.",
            'n' => 1,
            'size' => '1024x1024',
        ]);

        return $response->data[0]->url;
    }

}
