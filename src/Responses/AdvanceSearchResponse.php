<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class AdvanceSearchResponse
{
    public $response;

    public function __construct($response) {
        $this->response = new Response($response);
    }

}
