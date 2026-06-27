<?php

namespace App;

class OpenCodeAI
{
    public static function analyzeVisitorRisk(string $fullName, ?string $company): array
    {
        $risk = 'low';

        if (preg_match('/\b(admin|test|guest|unknown)\b/i', $fullName)) {
            $risk = 'high';
        }

        if ($company && preg_match('/\b(anonymous|temp|fake)\b/i', $company)) {
            $risk = 'high';
        }

        return ['risk' => $risk];
    }
}
