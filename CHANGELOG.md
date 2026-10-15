# Changelog

All notable changes to `contextr` will be documented in this file.

## Unreleased

- The default OpenAI model is `gpt-6-luna`. OpenAI retires GPT-4o, GPT-4o mini, GPT-4.1, and GPT-4.1 mini on 2027-01-14; `gpt-6-luna` is the recommended replacement.
- From 2027-01-14 (UTC), a configured `gpt-4o`, `gpt-4o-mini`, `gpt-4.1`, `gpt-4.1-mini`, or dated snapshot from that notice (`gpt-4o-2024-08-06`, `gpt-4o-2024-11-20`, `gpt-4o-mini-2024-07-18`, `gpt-4.1-2025-04-14`, `gpt-4.1-mini-2025-04-14`) is sent as `gpt-6-luna`. Until that date the configured id is unchanged. Other ids pass through. The stored config value is not rewritten.
- This package only chooses the model id. Temperature and reasoning effort still come from `jeffreyvr/contextr`.
