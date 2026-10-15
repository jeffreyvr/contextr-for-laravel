<?php

use Contextr\Providers\OpenAi;
use ContextrForLaravel\OpenAiModel;
use Illuminate\Support\Carbon;

beforeEach(function () {
    config()->set('contextr.default_provider', 'openai');
    config()->set('contextr.providers.openai.api_key', 'test-key');
});

afterEach(function () {
    Carbon::setTestNow();
});

it('defaults a missing model to gpt-6-luna', function (?string $model) {
    expect(OpenAiModel::resolve($model))->toBe(OpenAiModel::DEFAULT);
})->with([
    'null' => null,
    'empty' => '',
    'blank' => '   ',
]);

it('sends every retired id to gpt-6-luna', function () {
    expect(array_unique(array_values(OpenAiModel::RETIRED_ALIASES)))->toBe([OpenAiModel::DEFAULT])
        ->and(OpenAiModel::DEFAULT)->toBe('gpt-6-luna')
        ->and(OpenAiModel::RETIREMENT_DATE)->toBe('2027-01-14');
});

it('keeps a retired model until the shutdown date', function (string $model) {
    $before = Carbon::parse('2027-01-13 23:59:59', 'UTC');

    expect(OpenAiModel::resolve($model, $before))->toBe($model);
})->with(array_keys(OpenAiModel::RETIRED_ALIASES));

it('maps a retired model to gpt-6-luna from the shutdown date', function (string $model) {
    $onShutdown = Carbon::parse('2027-01-14 00:00:00', 'UTC');

    expect(OpenAiModel::resolve($model, $onShutdown))->toBe('gpt-6-luna')
        ->and(OpenAiModel::resolve('  '.$model.'  ', $onShutdown))->toBe('gpt-6-luna')
        ->and(OpenAiModel::resolve(strtoupper($model), $onShutdown))->toBe('gpt-6-luna');
})->with(array_keys(OpenAiModel::RETIRED_ALIASES));

it('uses the utc date when the local date is still the day before', function () {
    $eveningBeforeInNewYork = Carbon::parse('2027-01-13 20:00:00', 'America/New_York');

    expect(OpenAiModel::resolve('gpt-4o-mini', $eveningBeforeInNewYork))->toBe('gpt-6-luna');
});

it('passes other model ids through', function (string $model) {
    $onShutdown = Carbon::parse('2027-01-14 00:00:00', 'UTC');

    expect(OpenAiModel::resolve($model, $onShutdown))->toBe(trim($model));
})->with([
    'gpt-6-luna',
    'gpt-6.1-sol',
    'gpt-6-astra',
    'ft:gpt-4o-mini-2024-07-18:org:custom:abc123',
    'gpt-4o-2024-05-13',
    'gpt-4.1-nano',
]);

it('publishes gpt-6-luna as the config default', function () {
    expect(config('contextr.providers.openai.model'))->toBe('gpt-6-luna')
        ->and(app('contextr')->provider)->toBeInstanceOf(OpenAi::class)
        ->and(app('contextr')->provider->model)->toBe('gpt-6-luna');
});

it('uses gpt-6-luna when a published config has no model', function () {
    config()->set('contextr.providers.openai.model', null);

    expect(app('contextr')->provider->model)->toBe('gpt-6-luna');
});

it('keeps a published retired model before the shutdown date', function () {
    Carbon::setTestNow(Carbon::parse('2027-01-13 23:59:59', 'UTC'));
    config()->set('contextr.providers.openai.model', 'gpt-4o-mini');

    expect(app('contextr')->provider->model)->toBe('gpt-4o-mini');
});

it('rewrites a published retired model from the shutdown date', function () {
    Carbon::setTestNow(Carbon::parse('2027-01-14 00:00:00', 'UTC'));
    config()->set('contextr.providers.openai.model', 'gpt-4.1');

    expect(app('contextr')->provider->model)->toBe('gpt-6-luna')
        ->and(config('contextr.providers.openai.model'))->toBe('gpt-4.1');
});

it('passes a configured current model through to the provider', function () {
    config()->set('contextr.providers.openai.model', 'gpt-6.1-sol');

    expect(app('contextr')->provider->model)->toBe('gpt-6.1-sol');
});
