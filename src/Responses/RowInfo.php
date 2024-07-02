<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class RowInfo
{
    public string $number;
    public string $description;
    public ?RowInfoProperty $lifecyclePhase;
    public ?RowInfoProperty $rev;
    public ?RowInfoProperty $itemType;

    public function __construct(string $number, string $description, ?RowInfoProperty $lifecyclePhase, ?RowInfoProperty $rev, ?RowInfoProperty $itemType) {
        $this->number = $number;
        $this->description = $description;
        $this->lifecyclePhase = $lifecyclePhase;
        $this->rev = $rev;
        $this->itemType = $itemType;
    }

}
