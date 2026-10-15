<?php

return [
    'default_provider' => env('CONTEXTR_DEFAULT_PROVIDER'),

    'providers' => [
        'openai' => [
            'api_key' => env('CONTEXTR_OPENAI_API_KEY'),

            /*
             * OpenAI retires GPT-4o, GPT-4o mini, GPT-4.1, and GPT-4.1 mini
             * on 2027-01-14 and recommends gpt-6-luna.
             * https://developers.openai.com/api/docs/deprecations
             *
             * A published config that still names one of those models, or a
             * dated snapshot from that notice, is sent as gpt-6-luna from
             * 2027-01-14 (UTC). Other model ids are left unchanged.
             */
            'model' => env('CONTEXTR_OPENAI_MODEL', 'gpt-6-luna'),
        ],

        'grok' => [
            'api_key' => env('CONTEXTR_GROK_API_KEY'),
            'model' => env('CONTEXTR_GROK_MODEL'),
        ],
    ],
];
