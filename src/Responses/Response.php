<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Response
{
    public $messageId;
    public $messageName;
    public $statusCode;
    public $table;

    public function __construct($data) {
        $this->messageId = $data->messageId;
        $this->messageName = $data->messageName;
        $this->statusCode = $data->statusCode;
        $this->table = new Table($data->table);
    }


}
