<?php

namespace Shakewell\LaravelAgilePlm\Services;

interface AgilePlmService
{

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision);

//    public function getDocumentByObjectId($objectNumber, $objectId);


    public function searchEcoByDocumentNumberAndRevision($documentNumber, $documentRevision);

    public function searchEcrByDocumentNumberAndRevision($documentNumber, $documentRevision);

}
