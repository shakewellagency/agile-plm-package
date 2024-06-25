<?php

namespace Shakewell\LaravelAgilePlm\Services\implementation;

use League\CommonMark\Extension\Table\TableRow;
use Shakewell\LaravelAgilePlm\Entities\AgileDocument;
use Shakewell\LaravelAgilePlm\Enums\ResponseStatus;
use Shakewell\LaravelAgilePlm\Responses\AdvanceSearchResponse;
use Shakewell\LaravelAgilePlm\Responses\Response;
use Shakewell\LaravelAgilePlm\Responses\Row;
use Shakewell\LaravelAgilePlm\Responses\Table;
use Shakewell\LaravelAgilePlm\Services\AgilePlmService;

class AgilePlmServiceImpl implements AgilePlmService
{

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision): AgileDocument
    {

        $searchEndpoint = "/CoreService/services/Search?wsdl";

        $wsdl = config('agile-plm.soap_endpoint') . $searchEndpoint;

        $options = [
            'login' => config('agile-plm.username'),
            'password' => config('agile-plm.password'),
            'trace' => true, // Enable trace to debug the response
        ];

        $client = new \SoapClient($wsdl, $options);

        $params = [
            'request' => [
                'classIdentifier' => 'Document',
                'criteria' => "[Title Block.Number] Equal to '$documentNumber' And [Title Block.Rev] Equal to '$documentRevision'",
                'caseSensitive' => false,
            ],
        ];


        $response = $client->advancedSearch($params);

        dd($response);

        $searchResponse = (new AdvanceSearchResponse($response->response))->response;

        return $this->convertResponseToDocument($searchResponse);

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
}
