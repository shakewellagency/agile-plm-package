<?php

// config for Shakewell/LaravelAgilePlm
return [

    /**
     * Endpoint for accessing SOAP Resources
     */
    'soap_endpoint' => env('AGILE_PLM_SOAP_ENDPOINT'),

    /**
     * Username for accessing the SOAP Endpoint
     */
    'username' => env('AGILE_PLM_SOAP_USERNAME'),

    /**
     * Password for accessing the SOAP Endpoint
     */
    'password' => env('AGILE_PLM_SOAP_PASSWORD'),

];
