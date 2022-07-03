<?php

namespace App\Domains\Shift\Enums;



enum ShiftTypes: string
{

    case morningShift = 'MORNING';
    case eveningShift = 'EVENING';
    case nightShift = 'NIGHT';

    public static function values()
    {
        return collect(ShiftTypes::cases())->pluck('value')->toArray();
    }
}
