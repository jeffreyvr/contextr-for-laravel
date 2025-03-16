<?php

return [
    'default_provider' => env('CONTEXTR_DEFAULT_PROVIDER'),

    'providers' => [
        'openai' => [
            'api_key' => env('CONTEXTR_OPENAI_API_KEY'),
            'model' => env('CONTEXTR_OPENAI_MODEL')
        ],

        'grok' => [
            'api_key' => env('CONTEXTR_GROK_API_KEY'),
            'model' => env('CONTEXTR_GROK_MODEL')
        ],
    ]
];
