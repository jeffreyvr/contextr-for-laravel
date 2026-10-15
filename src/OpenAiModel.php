<?php

namespace ContextrForLaravel;

use DateTimeInterface;
use Illuminate\Support\Carbon;

/**
 * Model id passed to the OpenAI provider.
 *
 * OpenAI shuts down GPT-4o, GPT-4o mini, GPT-4.1, and GPT-4.1 mini on
 * 2027-01-14 and recommends gpt-6-luna. Retired ids are left unchanged until
 * that UTC date, then replaced. Any other id is passed through.
 *
 * @see https://developers.openai.com/api/docs/deprecations
 */
class OpenAiModel
{
    public const DEFAULT = 'gpt-6-luna';

    public const RETIREMENT_DATE = '2027-01-14';

    /**
     * Retired ids => replacement. Includes the unversioned aliases (what
     * published configs usually store) and the dated snapshots named in the
     * 2027-01-14 deprecation notice.
     *
     * @var array<string, string>
     */
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
