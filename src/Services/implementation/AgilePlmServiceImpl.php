<?php

namespace Shakewell\LaravelAgilePlm\Services\implementation;

use League\CommonMark\Extension\Table\TableRow;
use Shakewell\LaravelAgilePlm\Entities\AgileDocument;
use Shakewell\LaravelAgilePlm\Entities\AgileECO;
use Shakewell\LaravelAgilePlm\Enums\ResponseStatus;
use Shakewell\LaravelAgilePlm\Responses\AdvanceSearchResponse;
use Shakewell\LaravelAgilePlm\Responses\Response;
use Shakewell\LaravelAgilePlm\Responses\Row;
use Shakewell\LaravelAgilePlm\Responses\Table;
use Shakewell\LaravelAgilePlm\Services\AgilePlmService;

class AgilePlmServiceImpl implements AgilePlmService
{

    function __construct()
    {
        $this->options = [
            'login' => config('agile-plm.username'),
            'password' => config('agile-plm.password'),
            'trace' => true, // Enable trace to debug the response
        ];

    }

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision): AgileDocument
    {

        $searchEndpoint = "/CoreService/services/Search?wsdl";

        $wsdl = config('agile-plm.soap_endpoint') . $searchEndpoint;

        $client = new \SoapClient($wsdl, $this->options);

        $params = [
            'request' => [
                'classIdentifier' => 'Document',
                'criteria' => "[Title Block.Number] contains '$documentNumber' And [Title Block.Rev] Equal to '$documentRevision'",
                'caseSensitive' => false,
            ],
        ];


        $response = $client->advancedSearch($params);


        $searchResponse = (new AdvanceSearchResponse($response->response))->response;

        return $this->convertResponseToDocument($searchResponse);

    }


    public function getDocumentByObjectId($objectNumber, $objectId)
    {
        $endpoint = "/CoreService/services/BusinessObject?wsdl";

        $wsdl = config('agile-plm.soap_endpoint') . $endpoint;

        $client = new \SoapClient($wsdl, $this->options);

        $params = [
            'request' => [
                'requests' => [
                    'classIdentifier' => 'Changes',
                    'objectNumber' => $objectNumber,
//                    'referenceObjectKey' => $objectId
                ],

            ]
        ];

        dump($params);

        $response = $client->getObject($params);

        return $response;

    }


    public function searchChangeItemsByDocumentNumberAndRevision($documentNumber, $documentRevision)
    {
        $searchEndpoint = "/CoreService/services/Search?wsdl";

        $wsdl = config('agile-plm.soap_endpoint') . $searchEndpoint;

        $client = new \SoapClient($wsdl, $this->options);


        $searchTerm = $documentNumber . " Rev " . $documentRevision;

        $params = [
            'request' => [
                'classIdentifier' => 'ECO',
                'criteria' => "[Description of Change] contains '$searchTerm'",
                'caseSensitive' => false,
            ],
        ];


        $response = $client->advancedSearch($params);

//        dump($response);

        $searchResponse = (new AdvanceSearchResponse($response->response))->response;

//        return $searchResponse;

        return $this->convertResponseToECO($searchResponse);
    }


    private function convertResponseToDocument($response): ?AgileDocument
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

    private function convertResponseToECO($response): ?AgileECO{

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

        return new AgileECO(
            $row->rowInfo->number,
        );

    }


}
