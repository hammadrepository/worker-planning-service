<?php

namespace App\Domains\Shift\Http\Mappers;

use App\Domains\Shift\Entity\Shift;
use App\Domains\Shift\Entity\UserShift;
use App\Domains\Shift\Models\UserShift as UserShiftModel;
use App\Domains\Shift\Models\Shift as ShiftModel;
use App\Domains\Shift\Enums\ShiftTypes;
use App\Domains\Worker\Entity\Worker;
use Cassandra\Date;

class UserShiftFromHTTP
{


    private const UPDATABLE_FIELDS = [
        'name',
        'phone',
        'email',
        'language',
        'isActive',
        'image'
    ];


    public function mapEntityFromUserShiftCreate(array $params, ?int $id = null): UserShift
    {
        $shift = new UserShift();
        $userShift = ShiftModel::find($params['shift_id']);
        if ($id) {
            $shift->id = $id;
        }
        if(isset($params['worker_id'])){
            $shift->worker_id = $params['worker_id'];
        }

        $shift->shift_type = ShiftTypes::tryFrom($userShift->types);

        $shift->shift_id = $params['shift_id'] ?? null;
        $shift->date = $params['date'] ?? null;
        if(isset($params['start_time'])){
            $shift->shift_start_time = $params['start_time'] ?? null;
        }
        if(isset($params['end_time'])){
            $shift->shift_end_time = $params['end_time'] ?? null;
        }

        return $shift;
    }

    public function mapEntityFromUserShiftUpdate(array $params): UserShift
    {

        $params['id'] = $params['user_shift_id'];
        return $this->mapEntityFromUserShiftCreate($params, $params['id']);
    }

}
