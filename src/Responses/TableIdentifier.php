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
        $this->classId = $data->classId;
        $this->className = $data->className;
        $this->objectId = $data->objectId;
        $this->objectName = $data->objectName;
        $this->tableId = $data->tableId;
        $this->tableName = $data->tableName;
        $this->tableDisplayName = $data->tableDisplayName;
    }
}
