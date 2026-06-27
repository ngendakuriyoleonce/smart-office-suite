<?php

namespace App\Services;

class OpenCodeAIService
{
    public function analyzeVisitorRisk(string $fullName, ?string $company): array
    {
        $risk = 'low';
        $reasons = [];

        $name = strtolower($fullName);
        $companyName = strtolower($company ?? '');

        if (preg_match('/\b(admin|test|guest|unknown)\b/', $name)) {
            $risk = 'high';
            $reasons[] = 'The visitor name contains suspicious keywords.';
        }

        if ($companyName && preg_match('/\b(test|demo|sample|unknown|n\/a)\b/i', $companyName)) {
            $risk = 'high';
            $reasons[] = 'The company name appears to be invalid or suspicious.';
        }

        return [
            'risk' => $risk,
            'reasons' => $reasons,
            'score' => $risk === 'high' ? 0.9 : 0.1,
        ];
    }
}
