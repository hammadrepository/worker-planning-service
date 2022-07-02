<?php

namespace App\Domains\Worker\Http\Mappers;

use App\Domains\Worker\Entity\Worker;

class WorkerMapper
{


    private const UPDATABLE_FIELDS = [
        'name',
        'phone',
        'email',
        'language',
        'isActive',
        'image'
    ];


    public function mapEntityFromCreateHttp(array $params, ?int $id = null): Worker
    {
        $worker = new Worker();

        if ($id) {
            $worker->id = $id;
        }

        $worker->first_name = $params['first_name'];
        $worker->last_name = $params['last_name'] ?? null;
        $worker->email = $params['email'] ?? null;

        return $worker;
    }

}
