<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Response
{
    public $messageId;
    public $messageName;
    public $statusCode;
    public $table;

    public function __construct($data) {

        if (property_exists($data, "messageId")) {
            $this->messageId = $data->messageId;
        }

        if (property_exists($data, "messageName")) {
            $this->messageName = $data->messageName;
        }

        if (property_exists($data, "statusCode")) {
            $this->statusCode = $data->statusCode;
        }

        if (property_exists($data, "table")) {
            $this->table = new Table($data->table);
        }


    }


}
