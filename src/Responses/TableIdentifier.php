<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class TableIdentifier
{
    public $classId;
    public $className;
    public $objectId;
    public $objectName;
    public $tableId;
    public $tableName;
    public $tableDisplayName;

    public function __construct($data) {
        foreach (get_object_vars($this) as $property => $value) {
            if (property_exists($data, $property)) {
                $this->$property = $data->$property;
            }
        }
    }
}
