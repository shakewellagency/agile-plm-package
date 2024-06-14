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
        $this->classId = $data->classId;
        $this->className = $data->className;
        $this->classDisplayName = $data->classDisplayName;
        $this->objectId = $data->objectId;
        $this->objectName = $data->objectName;
        $this->objectVersion = $data->objectVersion;
        $this->version = $data->version;
    }

}
