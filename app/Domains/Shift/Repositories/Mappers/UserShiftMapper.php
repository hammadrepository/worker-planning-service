<?php

namespace App\Domains\Shift\Repositories\Mappers;

use App\Domains\Shift\Enums\ShiftTypes;
use App\Domains\Shift\Models\UserShift;
use App\Domains\Shift\Models\Shift;
use App\Domains\Shift\Entity\UserShift as UserShiftEntity;


class UserShiftMapper
{

    public function mapToEntity(UserShift $model, bool $existed = true): UserShiftEntity
    {
        $shift = new UserShiftEntity();

        if ($existed) {
            $shift->id = $model->id;
        }
        $shift->worker_id = $model->user_id;
        $shift->shift_id = $model->shift_id;
        $shift->shift_type = ShiftTypes::tryFrom($model->shift_type);
        $shift->shift_end_time = $model->shift_end_time ?? null;
        $shift->shift_start_time = $model->shift_start_time ?? null;
        $shift->date = $model->date ?? null;

        return $shift;
    }


}
