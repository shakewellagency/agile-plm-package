<?php

namespace Shakewell\LaravelAgilePlm\Responses;

class Row
{
    public ObjectReferentId $objectReferentId;
    public $additionalRowInfo;
    public $rowId;

    public RowInfo $rowInfo;

    public function __construct($data) {
        if(property_exists($data, "objectReferentId")) {
            $this->objectReferentId = new ObjectReferentId($data->objectReferentId);
        }

        if(property_exists($data, "additionalRowInfo")) {
            $this->additionalRowInfo = $data->additionalRowInfo;
        }

        if(property_exists($data, "any") && is_array($data->any)) {
            $rowInfo = $data->any;


            $lifecyclePhase = is_array($rowInfo) && array_key_exists("lifecyclePhase", $rowInfo)? $rowInfo["lifecyclePhase"]: null;
            $rev = is_array($rowInfo) && array_key_exists("rev", $rowInfo)? $rowInfo["rev"]: null;
            $itemType = is_array($rowInfo) && array_key_exists("itemType", $rowInfo )? $rowInfo["itemType"]: null;


            $description = "";
            if(array_key_exists("description", $rowInfo, )){
                $description = $rowInfo["description"];
            }elseif (array_key_exists("descriptionOfChange", $rowInfo, )){
                $description = $rowInfo["descriptionOfChange"];
            }

            $this->rowInfo = new RowInfo(
                array_key_exists("number", $rowInfo) ? $rowInfo["number"] : "",
                $description,
                $lifecyclePhase ? new RowInfoProperty(
                    property_exists($lifecyclePhase, "listName") ? $lifecyclePhase->listName : null,
                    property_exists($lifecyclePhase, "selection") ? new Selection($lifecyclePhase->selection) : null,
                ) : null,
                $rev ? new RowInfoProperty(
                    property_exists($rev, "listName") ? $rev->listName : null,
                    property_exists($rev, "selection") ? new Selection($rev->selection) : null,
                ): null,
                $itemType ? new RowInfoProperty(
                    property_exists($itemType, "listName") ? $itemType->listName : null,
                    property_exists($itemType, "selection") ? new Selection($itemType->selection) : null,
                ): null
            );


        }

        if(property_exists($data, "rowId")) {
            $this->rowId = $data->rowId;
        }



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
