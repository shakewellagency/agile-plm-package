<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Row
{
    public $objectReferentId;
    public $additionalRowInfo;
    public $any;
    public $rowId;

    public function __construct($data) {
        $this->objectReferentId = new ObjectReferentId($data->objectReferentId);
        $this->additionalRowInfo = $data->additionalRowInfo;
        $this->any = $this->mapAnyArray($data->any);
        $this->rowId = $data->rowId;


    }

    private function mapAnyArray($anyArray) {
        $mappedArray = [];
        foreach ($anyArray as $key => $value) {
            if (is_object($value)) {
                if (isset($value->id) && isset($value->apiName) && isset($value->value)) {
                    $mappedArray[$key] = new Selection($value);
                } else {
                    // Handle other types of objects if necessary
                    $mappedArray[$key] = $value;
                }
            } else {
                $mappedArray[$key] = $value;
            }
        }
        return $mappedArray;
    }
}
