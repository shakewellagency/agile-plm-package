<?php

namespace Shakewell\LaravelAgilePlm\Services\implementation;

use Shakewell\LaravelAgilePlm\Responses\AdvanceSearchResponse;
use Shakewell\LaravelAgilePlm\Responses\Response;
use Shakewell\LaravelAgilePlm\Services\AgilePlmService;

class AgilePlmServiceImpl implements AgilePlmService
{

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision): Response
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
//                'criteria' => "[Title Block.Number] Equal to '0200-06288-1000' And [Title Block.Rev] Equal to 'C'",
                'caseSensitive' => false,
            ],
        ];

//        dd($params);

        $response = $client->advancedSearch($params);


        $advanceSearchResponse =  new AdvanceSearchResponse($response->response);

        return $advanceSearchResponse->response;
    }
}
