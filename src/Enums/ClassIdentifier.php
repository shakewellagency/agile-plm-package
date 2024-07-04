<?php

namespace Shakewell\LaravelAgilePlm\Enums;

enum ClassIdentifier
{
    case DOCUMENT;
    case ECO;
    case ECR;


    public function getValue(): string
    {
        return match($this) {
            self::DOCUMENT => 'Document',
            self::ECO => 'ECO',
            self::ECR => 'BAECR',
        };
    }

}
