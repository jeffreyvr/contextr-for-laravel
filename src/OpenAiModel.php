<?php

namespace ContextrForLaravel;

use DateTimeInterface;
use Illuminate\Support\Carbon;

class OpenAiModel
{
    public const DEFAULT = 'gpt-6-luna';

    public const RETIREMENT_DATE = '2027-01-14';

    /** @var array<string, string> */
    public const RETIRED_ALIASES = [
        'gpt-4o' => self::DEFAULT,
        'gpt-4o-2024-08-06' => self::DEFAULT,
        'gpt-4o-2024-11-20' => self::DEFAULT,
        'gpt-4o-mini' => self::DEFAULT,
        'gpt-4o-mini-2024-07-18' => self::DEFAULT,
        'gpt-4.1' => self::DEFAULT,
        'gpt-4.1-2025-04-14' => self::DEFAULT,
        'gpt-4.1-mini' => self::DEFAULT,
        'gpt-4.1-mini-2025-04-14' => self::DEFAULT,
    ];

    public static function resolve(?string $model, DateTimeInterface|string|null $now = null): string
    {
        if (! is_string($model) || trim($model) === '') {
            return self::DEFAULT;
        }

        $model = trim($model);
        $replacement = self::RETIRED_ALIASES[strtolower($model)] ?? null;

        if ($replacement === null) {
            return $model;
        }

        $instant = $now === null ? Carbon::now() : Carbon::parse($now);

        if ($instant->utc()->toDateString() >= self::RETIREMENT_DATE) {
            return $replacement;
        }

        return $model;
    }
}
