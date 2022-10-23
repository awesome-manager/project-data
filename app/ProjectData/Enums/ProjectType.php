<?php

namespace App\ProjectData\Enums;

enum ProjectType: string
{
    case TIMES_AND_MATERIALS = 'TM';
    case FIX_PRICE = 'FIX';

    public static function getTypes(): array
    {
        return [
            self::FIX_PRICE->value,
            self::TIMES_AND_MATERIALS->value
        ];
    }

    public static function inTypes(string $type): bool
    {
        return in_array($type, self::getTypes());
    }
}
