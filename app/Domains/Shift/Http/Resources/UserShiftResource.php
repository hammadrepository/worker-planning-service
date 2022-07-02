<?php

namespace App\Domains\Shift\Http\Resources;

use App\Domains\Shift\Entity\UserShift;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  UserShift
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_shift_id' => $this->id,
            'worker_id' => $this->worker_id,
            'shift_id' => $this->shift_id,
            'shift_type' => $this->shift_type,
            'date' => $this->date,

        ];
    }
}
