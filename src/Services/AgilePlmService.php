<?php

namespace Shakewell\LaravelAgilePlm\Services;

interface AgilePlmService
{

    public function searchDocumentByNumberAndRevision($documentNumber, $documentRevision);

}
