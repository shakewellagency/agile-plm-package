<?php

namespace Shakewell\LaravelAgilePlm\Entities;

class AgileDocument
{

    public string $id;
    public string $documentNumber;

    public string $revision;
    public string $description;

    public string $lifeCyclePhase;

    public string $ItemType;

    function __construct($id,  $documentNumber, $revision, $description, $lifeCyclePhase, $ItemType)
    {
        $this->id = $id;
        $this->documentNumber = $documentNumber;
        $this->revision = $revision;
        $this->description = $description;
        $this->lifeCyclePhase = $lifeCyclePhase;
        $this->ItemType = $ItemType;

    }



}
