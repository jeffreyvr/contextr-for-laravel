<?php

return [
    'default_provider' => env('CONTEXTR_DEFAULT_PROVIDER'),

    'providers' => [
        'openai' => [
            'api_key' => env('CONTEXTR_OPENAI_API_KEY'),
            // Retired GPT-4o / 4.1 ids alias to gpt-6-luna from 2027-01-14.
            'model' => env('CONTEXTR_OPENAI_MODEL', 'gpt-6-luna'),
        ],

        'grok' => [
            'api_key' => env('CONTEXTR_GROK_API_KEY'),
            'model' => env('CONTEXTR_GROK_MODEL'),
        ],
    ],
];
