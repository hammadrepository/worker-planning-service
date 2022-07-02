<?php

namespace App\Domains\Worker\Repositories\Mappers;

use App\Domains\Worker\Models\Worker;
use App\Domains\Worker\Entity\Worker as WorkerEntity;


class WorkerMapper
{

    public function mapToEntity(Worker $model, bool $existed = true): WorkerEntity
    {
        $worker = new WorkerEntity();

        if ($existed) {
            $worker->id = $model->id;
        }

        $worker->first_name = $model->first_name ?? null;
        $worker->last_name = $model->last_name ?? null;
        $worker->email = $model->email ?? null;


        return $worker;
    }

    public function mapToModel(WorkerEntity $worker, bool $existed = true): Worker
    {
        $model = new Worker();

        if ($existed) {
            $model->id = $worker->id;
        }

        $model->first_name = $worker->first_name ?? null;
        $model->last_name = $worker->last_name ?? null;
        $model->email = $worker->email ?? null;


        return $model;
    }

}
