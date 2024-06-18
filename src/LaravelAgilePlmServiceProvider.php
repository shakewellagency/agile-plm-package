<?php

namespace Shakewell\LaravelAgilePlm;

use Shakewell\LaravelAgilePlm\Services\AgilePlmService;
use Shakewell\LaravelAgilePlm\Services\implementation\AgilePlmServiceImpl;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Shakewell\LaravelAgilePlm\Commands\LaravelAgilePlmCommand;

class LaravelAgilePlmServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-agile-plm')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-agile-plm_table')
            ->hasCommand(LaravelAgilePlmCommand::class);
    }

    public function boot()
    {
        $this->app->bind(AgilePlmService::class, AgilePlmServiceImpl::class);

        return parent::boot();

    }
}
