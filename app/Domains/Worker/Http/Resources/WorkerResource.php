<?php

namespace App\Domains\Worker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $item
     * @return array
     */
    public function toArray($item)
    {
        return [
            'id' => $item->id,
            'first_name' => $item->first_name ?? '',
            'last_name' => $item->last_name,
            'email' => $item->email,
        ];
    }
}
