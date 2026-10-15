<div align="center">
    <picture>
    <source
    srcset="https://raw.githubusercontent.com/jeffreyvr/contextr/refs/heads/main/art/logo-light.svg"
    media="(prefers-color-scheme: dark)"
    height="50"
    />
    <img
    src="https://raw.githubusercontent.com/jeffreyvr/contextr/refs/heads/main/art/logo-dark.svg"
    alt="contextr logo"
    height="50"
    />
    </picture>

  <h3 align="center">contextr</h3>
</div>

<p align="center">
<a href="https://packagist.org/packages/jeffreyvanrossum/contextr-for-laravel"><img src="https://img.shields.io/packagist/dt/jeffreyvanrossum/contextr-for-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/jeffreyvanrossum/contextr-for-laravel"><img src="https://img.shields.io/packagist/v/jeffreyvanrossum/contextr-for-laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jeffreyvanrossum/contextr-for-laravel"><img src="https://img.shields.io/packagist/l/jeffreyvanrossum/contextr-for-laravel" alt="License"></a>
</p>

AI-driven text analysis for spam, sentiment, moderation, and more.

## Installation

You can install the package via composer:

```bash
composer require jeffreyvanrossum/contextr-for-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="contextr-config"
```

The OpenAI provider defaults to `gpt-6-luna`.

OpenAI retires GPT-4o, GPT-4o mini, GPT-4.1, and GPT-4.1 mini on January 14, 2027. The recommended replacement is `gpt-6-luna` ([deprecations](https://developers.openai.com/api/docs/deprecations)).

`CONTEXTR_OPENAI_MODEL` — including a value already saved in a published config — may still name one of those models or a dated snapshot from that notice (`gpt-4o-2024-08-06`, `gpt-4o-2024-11-20`, `gpt-4o-mini-2024-07-18`, `gpt-4.1-2025-04-14`, `gpt-4.1-mini-2025-04-14`). From 2027-01-14 (UTC) this package sends `gpt-6-luna` instead. Until that date the configured id is left unchanged. Any other model id is sent as-is. The stored config value is not rewritten; the replacement is applied when the client is created.

This package only chooses the model id. Request fields such as temperature and reasoning effort come from [`jeffreyvr/contextr`](https://github.com/jeffreyvr/contextr).

## Usage

```php
Contextr::spam()
    ->text('Buy cheap viagra now!!! Click here: shady.link')
    ->context([
        'topic' => 'Health Forum Discussion',
        'user_history' => 'First time poster'
    ])
    ->withReasoning()
    ->analyze();

$check->data();         // full result array
$check->spam();         // true (boolean)
$check->confidence();   // 0.95 (float)
$check->reasoning();    // "Contains promotional content and suspicious link"
```

For more examples, see:

https://github.com/jeffreyvr/contextr?tab=readme-ov-file#examples

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jeffrey van Rossum](https://github.com/jeffreyvr)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
