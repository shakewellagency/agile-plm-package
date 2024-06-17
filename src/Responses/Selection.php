<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Selection
{
    public $id;
    public $apiName;
    public $value;

    public function __construct($data) {
        foreach (get_object_vars($this) as $property => $value) {
            if (property_exists($data, $property)) {
                $this->$property = $data->$property;
            }
        }
    }
}
