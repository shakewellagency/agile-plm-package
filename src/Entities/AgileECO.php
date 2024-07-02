<?php

namespace Shakewell\LaravelAgilePlm\Entities;

class AgileECO
{

    public string $number;


    function __construct(string $number)
    {
        $this->number = $number;
    }



}
