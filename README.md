# Laravel Package for Agile PLM

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shakewell/laravel-agile-plm.svg?style=flat-square)](https://packagist.org/packages/shakewell/laravel-agile-plm)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/shakewell/laravel-agile-plm/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/shakewell/laravel-agile-plm/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/shakewell/laravel-agile-plm/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/shakewell/laravel-agile-plm/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/shakewell/laravel-agile-plm.svg?style=flat-square)](https://packagist.org/packages/shakewell/laravel-agile-plm)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require shakewell/laravel-agile-plm
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="agile-plm-config"
```

This is the contents of the published config file:

```php
return [
    'soap_endpoint' => env('AGILE_PLM_SOAP_ENDPOINT'),
    'username' => env('AGILE_PLM_SOAP_USERNAME'),
    'password' => env('AGILE_PLM_SOAP_PASSWORD'),
];
```
Agile PLM SOAP access uses basic authentication.


## Usage

This package contains services that can be injected into the controller via Laravel
Dependency Injection

```php
use Shakewell\LaravelAgilePlm\Services\AgilePlmService;

public function handle(AgilePlmService $agilePlmService){
 // Code Here
}
```
The ``` AgoilePlmService``` contains different search methods

### Search for Document using Document Number and Document Revision
```php
$results = $agilePlmService->searchDocumentByNumberAndRevision("0200-06288-1000", "C");
```
This method will return an  ```AgileDocument``` class with the following properties or ```null``` 
if no document is found.

```php
    public string $id;
    public string $documentNumber;
    public string $revision;
    public string $description;
    public string $lifeCyclePhase;
    public string $ItemType;
```

### Search for ECO using Document Number and Document Revision
```php
$results = $agilePlmService->searchEcoByDocumentNumberAndRevision("0200-06288-1000", "C");
```

This method will return an  ```AgileChange``` class with the following properties or ```null```
if no ECO is found.
```php
    public string $number;
    public string $description;
```


### Search for ECR using Document Number and Document Revision
```php
$results = $agilePlmService->searchEcrByDocumentNumberAndRevision("0200-06288-1000", "C");
```

This method will return an  ```AgileChange``` class with the following properties or ```null```
if no ECO is found.
```php
    public string $number;
    public string $description;
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Andy Parinas](https://github.com/andy-shakewell)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
