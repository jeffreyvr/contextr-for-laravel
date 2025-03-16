<?php

namespace ContextrForLaravel;

use Contextr\Contextr;
use Contextr\Providers\Grok;
use Contextr\Providers\OpenAi;
use GrokPHP\Client\Enums\Model;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ContextrForLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('contextr')
            ->hasConfigFile();

        $this->app->singleton('contextr', function($app) {
            $provider = null;
            $defaultProvider = config('contextr.default_provider', 'openai');

            if($defaultProvider === 'openai') {
                $provider = new OpenAi(
                    apiKey: config('contextr.providers.openai.api_key'),
                    model: config('contextr.providers.openai.model', 'gpt-4o-mini')
                );
            } elseif($defaultProvider === 'grok') {
                $provider = new Grok(
                    apiKey: config('contextr.providers.grok.api_key'),
                    model: config('contextr.providers.grok.model', Model::GROK_2_LATEST)
                );
            }

            return new Contextr($provider);
        });
    }
}
