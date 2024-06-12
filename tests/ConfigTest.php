<?php

it('can test load config from .env file', function () {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $endpoint = $_ENV['AGILE_PLM_SOAP_ENDPOINT'];
    $userName = $_ENV['AGILE_PLM_SOAP_USERNAME'];
    $password = $_ENV['AGILE_PLM_SOAP_PASSWORD'];


    config()->set('agile-plm.soap_endpoint', $endpoint);
    config()->set('agile-plm.username', $userName);
    config()->set('agile-plm.password', $password);

    expect(config('agile-plm.soap_endpoint'))->toBe($endpoint)
        ->and(config('agile-plm.username'))->toBe($userName)
        ->and(config('agile-plm.password'))->toBe($password);


});
