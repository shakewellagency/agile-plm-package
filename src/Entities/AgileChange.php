<?php

namespace Shakewell\LaravelAgilePlm\Entities;

class AgileChange
{
    public string $number;

    public string $description;


    function __construct(string $number, string $description)
    {
        $this->number = $number;
        $this->description = $description;
    }
}
