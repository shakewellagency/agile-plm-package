<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class ObjectReferentId
{

    public $classId;
    public $className;
    public $classDisplayName;
    public $objectId;
    public $objectName;
    public $objectVersion;
    public $version;

    public function __construct($data) {
        foreach (get_object_vars($this) as $property => $value) {
            if (property_exists($data, $property)) {
                $this->$property = $data->$property;
            }
        }
    }

}
