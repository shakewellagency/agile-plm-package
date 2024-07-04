<?php

namespace Shakewell\LaravelAgilePlm\Services\implementation;

use League\CommonMark\Extension\Table\TableRow;
use Shakewell\LaravelAgilePlm\Entities\AgileChange;
use Shakewell\LaravelAgilePlm\Entities\AgileDocument;
use Shakewell\LaravelAgilePlm\Entities\AgileECO;
use Shakewell\LaravelAgilePlm\Enums\ClassIdentifier;
use Shakewell\LaravelAgilePlm\Enums\ResponseStatus;
use Shakewell\LaravelAgilePlm\Responses\AdvanceSearchResponse;
use Shakewell\LaravelAgilePlm\Responses\Response;
use Shakewell\LaravelAgilePlm\Responses\Row;
use Shakewell\LaravelAgilePlm\Responses\Table;
use Shakewell\LaravelAgilePlm\Services\AgilePlmService;
use Shakewell\LaravelAgilePlm\Services\AgileSearch;

class AgilePlmServiceImpl extends AgileSearch implements AgilePlmService
{

    function __construct()
    {
        $this->options = [
            'login' => config('agile-plm.username'),
            'password' => config('agile-plm.password'),
            'trace' => true, // Enable trace to debug the response
        ];

    }

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision): ?AgileDocument
    {

        $response = $this->search(ClassIdentifier::DOCUMENT,
            "[Title Block.Number] Equal to '$documentNumber' And [Title Block.Rev] Equal to '$documentRevision'");

        if($response == null) return null;

        $searchResponse = (new AdvanceSearchResponse($response->response))->response;

        return $this->convertResponseToDocument($searchResponse);

    }


    public function searchEcoByDocumentNumberAndRevision($documentNumber, $documentRevision)
    {

        $searchTerm = $documentNumber . " Rev " . $documentRevision;

        $response = $this->search(ClassIdentifier::ECO,
            "[Description of Change] contains '$searchTerm'");

        if($response == null) return null;

        $searchResponse = (new AdvanceSearchResponse($response->response))->response;


        return $this->convertResponseToChange($searchResponse);
    }



    public function searchEcrByDocumentNumberAndRevision($documentNumber, $documentRevision)
    {

        $searchTerm = $documentNumber . " Rev " . $documentRevision;

        $response = $this->search(ClassIdentifier::ECR,
            "[Description of Change] contains '$searchTerm'");

        if($response == null) return null;

        $searchResponse = (new AdvanceSearchResponse($response->response))->response;


        return $this->convertResponseToChange($searchResponse);
    }




}
