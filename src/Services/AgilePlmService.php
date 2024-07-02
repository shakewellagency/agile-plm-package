<?php

namespace Shakewell\LaravelAgilePlm\Services;

interface AgilePlmService
{

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision);

    public function getDocumentByObjectId($objectNumber, $objectId);


    public function searchChangeItemsByDocumentNumberAndRevision($documentNumber, $documentRevision);

}
