<?php

namespace Shakewell\LaravelAgilePlm\Commands;

use Illuminate\Console\Command;

class LaravelAgilePlmCommand extends Command
{
    public $signature = 'laravel-agile-plm';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
