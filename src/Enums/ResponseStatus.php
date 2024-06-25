<?php

namespace Shakewell\LaravelAgilePlm\Enums;

enum ResponseStatus
{
    case SUCCESS;
    case FAILURE;
    case ERROR;

    public static function fromString(string $value): ?self {
        foreach (self::cases() as $case) {
            if ($case->name === $value) {
                return $case;
            }
        }
        return self::ERROR;
    }

}
