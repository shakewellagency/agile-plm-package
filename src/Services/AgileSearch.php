<?php

namespace Shakewell\LaravelAgilePlm\Services;

use Shakewell\LaravelAgilePlm\Entities\AgileChange;
use Shakewell\LaravelAgilePlm\Entities\AgileDocument;
use Shakewell\LaravelAgilePlm\Enums\ClassIdentifier;
use Shakewell\LaravelAgilePlm\Enums\ResponseStatus;
use Shakewell\LaravelAgilePlm\Responses\Response;
use Shakewell\LaravelAgilePlm\Responses\Row;
use Shakewell\LaravelAgilePlm\Responses\Table;

class AgileSearch
{


    public function search(ClassIdentifier $classIdentifier, string $searchCriteria){

        $searchEndpoint = "/CoreService/services/Search?wsdl";

        $wsdl = config('agile-plm.soap_endpoint') . $searchEndpoint;

        $client = new \SoapClient($wsdl, $this->options);

        $params = [
            'request' => [
                'classIdentifier' => $classIdentifier->getValue(),
                'criteria' => $searchCriteria,
                'caseSensitive' => false,
            ],
        ];

        try {
            return $client->advancedSearch($params);

        }catch (\Exception $exception){
            return null;
        }

    }


    protected function convertResponseToDocument($response): ?AgileDocument
    {
        if (!$response instanceof Response) {
            return null;
        }

        if ($response->statusCode !== ResponseStatus::SUCCESS) {
            return null;
        }

        if (!$response->table instanceof Table) {
            return null;
        }

        if (!is_array($response->table->row) || count($response->table->row) === 0) {
            return null;
        }

        if (!$response->table->row[0] instanceof Row) {
            return null;
        }

        $row = $response->table->row[0];

        return new AgileDocument(
            $row->objectReferentId->objectId,
            $row->rowInfo->number,
            $row->rowInfo->rev->selection->value,
            $row->rowInfo->description,
            $row->rowInfo->lifecyclePhase->selection->value,
            $row->rowInfo->itemType->selection->value
        );
    }

    protected function convertResponseToChange($response): ?AgileChange{

        if (!$response instanceof Response) {
            return null;
        }

        if ($response->statusCode !== ResponseStatus::SUCCESS) {
            return null;
        }

        if (!$response->table instanceof Table) {
            return null;
        }

        if (!is_array($response->table->row) || count($response->table->row) === 0) {
            return null;
        }

        if (!$response->table->row[0] instanceof Row) {
            return null;
        }

        $row = $response->table->row[0];

        return new AgileChange(
            $row->rowInfo->number,
            $row->rowInfo->description
        );

    }



}
