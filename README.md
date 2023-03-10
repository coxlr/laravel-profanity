# A Laravel package to find and remove profanity from text strings.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coxlr/laravel-profanity.svg?style=flat-square)](https://packagist.org/packages/coxlr/laravel-profanity)
[![Tests](https://github.com/coxlr/laravel-profanity/actions/workflows/run-tests.yml/badge.svg)](https://github.com/coxlr/laravel-profanity/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/coxlr/laravel-profanity.svg?style=flat-square)](https://packagist.org/packages/coxlr/laravel-profanity)

## Installation

This package requires PHP 8.1 and Laravel 10 or higher.

To install the PHP client library using Composer:

```bash
composer require coxlr/laravel-profanity
```

The package will automatically register the `Profanity` provider and facade.


You can publish the config file with:
```bash
php artisan vendor:publish --provider="Coxlr\Profanity\ProfanityServiceProvider" --tag="config"
```


Then update `config/profanity.php` with your credentials. Alternatively, you can update your `.env` file with the following:

```dotenv
PROFANITY_REPLACEMENT_CHARACTER=*
PROFANITY_REPLACEMENT_LENGTH=4
PROFANITY_REPLACEMENT_LANGUAGES=en,es
```

## Usage

To use Profanity you can use the facade, or request the instance from the service container.

### Clean a string

```php
$cleansedText = Profanity::clean('Using the facade to cleanse a string.');

/*
  This function returns a string with any profanity found replaced with replace value set in the config.
*/
```

Or

```php
$profanity = app('profanity');

$cleansedText = $profanity->clean('Using the instance to cleanse a string.');
```

### Check if a string is clean or not

```php
$isClean = Profanity::isClean('The string to be checked.');

/*
  This function returns a boolean value. If the string is clean, it will return true. If the string contains profanity, it will return false.
*/
```

### To set the languages to use when searching for profanity

```php
$cleansedText = Profanity::setLanguages('en,es,fr')->clean('The string to be cleansed.');
```

### To set strict mode when search for and replace profanity

Strict mode will replace any profanity found even if it is found within a word, and not just the exact word. 

```php
$cleansedText = Profanity::setStrict(true)->clean('The string to be cleansed.');

$isClean = Profanity::setStrict(true)->isClean('The string to be checked.');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hey@leecox.me instead of using the issue tracker.

## Credits

- [Lee Cox](https://github.com/coxlr)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
