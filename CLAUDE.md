# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Run all tests
vendor/bin/phpunit

# Run a single test file
vendor/bin/phpunit tests/Transformer/TsvTransformerTest.php

# Run a specific test method
vendor/bin/phpunit --filter testTransform tests/Transformer/TsvTransformerTest.php

# Static analysis
vendor/bin/phpstan analyse -c phpstan.dist.neon

# Install dependencies
composer install
```

## Architecture

This is a Symfony library providing form data transformers for converting between user input and PHP data structures.

**Transformers** (`src/Transformer/`): Implement `DataTransformerInterface` to convert between view data (strings shown to users) and model data (arrays/values used in PHP):
- `TsvTransformer` - Tab-separated values to array of associative arrays (first row = keys)
- `JsonYamlTransformer` - YAML string to array (configurable inline level, indent, flags)
- `StringArrayTransformer` - Newline/comma-separated strings to array
- `EmptyStringTransformer` - Ensures empty string instead of null

**Helper** (`src/Helper/TsvHelper.php`): Static helper for TSV parsing with optional multiline support. Enable with `TsvHelper::$multiline = true` for quoted multiline fields.

**Usage pattern**: Inject transformer, add to form field with `$builder->get('fieldName')->addModelTransformer($transformer)`.

## Requirements

- PHP 8.4+
- Symfony 7.4+ or 8.0+
