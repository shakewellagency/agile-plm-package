<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Table
{

    public $tableIdentifier;
    public $row;

    public function __construct($data) {
        $this->tableIdentifier = new TableIdentifier($data->tableIdentifier);
        $this->row = array_map(function($row) {
            return new Row($row);
        }, $data->row);
    }

}
