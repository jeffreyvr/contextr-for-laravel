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
