<?php


use Shakewell\LaravelAgilePlm\Responses\AdvanceSearchResponse;

beforeAll(function (){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

});

it('can perform advance search', function () {

    $endpoint = $_ENV['AGILE_PLM_SOAP_ENDPOINT'];
    $userName = $_ENV['AGILE_PLM_SOAP_USERNAME'];
    $password = $_ENV['AGILE_PLM_SOAP_PASSWORD'];

    config()->set('agile-plm.soap_endpoint', $endpoint);
    config()->set('agile-plm.username', $userName);
    config()->set('agile-plm.password', $password);

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
            'criteria' => "[Title Block.Number] Equal to '0200-06288-1000' And [Title Block.Rev] Equal to 'C'",
//            'criteria' => "[Title Block.Number] contains '1000' And [Title Block.Rev] Equal to 'A'",
            'caseSensitive' => false,
        ],
    ];



    $response = $client->advancedSearch($params);


    $advanceSearchResponse = new AdvanceSearchResponse($response->response);

    dd($advanceSearchResponse);

});
