<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Selection
{
    public $id;
    public $apiName;
    public $value;

    public function __construct($data) {
        $this->id = $data->id;
        $this->apiName = $data->apiName;
        $this->value = $data->value;
    }
}
