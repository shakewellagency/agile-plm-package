<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Response
{
    public $messageId;
    public $messageName;
    public $statusCode;
    public $table;

    public function __construct($data) {

        foreach (get_object_vars($this) as $property => $value) {
            if (property_exists($data, $property)) {
                $this->$property = $data->$property;
            }
        }

    }


}
