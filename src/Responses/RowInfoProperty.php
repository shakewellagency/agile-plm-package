<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class RowInfoProperty
{
    public ?string $listName;
    public Selection $selection;

    public function __construct(?string $listName, Selection $selection) {
        $this->listName = $listName;
        $this->selection = $selection;
    }

}
