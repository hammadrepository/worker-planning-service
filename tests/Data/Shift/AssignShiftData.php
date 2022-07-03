<?php

namespace Tests\Data\Shift;


use Carbon\Carbon;

class AssignShiftData
{
    public static function getAssignShiftData(?int $id = null): array
    {
        if (!$id) {
            $id = rand(1, 999);
        }

        return [
            'worker_id' => $id,
            'shift_id' => rand(1,3),
            'date' => date('Y-m-d',strtotime( '+'.mt_rand(0,30).' days')) // Coming 30 Days
        ];
    }
}
