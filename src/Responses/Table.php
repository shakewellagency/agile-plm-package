<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Table
{

    public $tableIdentifier;
    public $row;

    public function __construct($data) {
        $this->tableIdentifier = new TableIdentifier($data->tableIdentifier);

        if(property_exists($data, "row")) {
            if(is_array($data->row)) {
                $this->row = array_map(function($row) {
                    return new Row($row);
                }, $data->row);
            }
            if(is_object($data->row)) {
                $this->row = new Row($data->row);
            }
        }

    }

}
