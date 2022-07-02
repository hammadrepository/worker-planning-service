<?php

namespace App\Domains\Worker\Repositories;

use App\Domains\Worker\Models\Worker;
use App\Domains\Worker\Entity\Worker as WorkerEntity;
use Illuminate\Database\Eloquent\Collection;
use App\Domains\Worker\Repositories\Mappers\WorkerMapper;

class WorkerRepository
{
    private WorkerMapper $mapper;

    public function __construct(WorkerMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getAll(): Collection
    {
        return Worker::all();
    }

    public function getById($id): WorkerEntity
    {
        return $this->mapper->mapToEntity(Worker::findOrFail($id));
    }

    public function findByEmail($email): Worker
    {
        return Worker::where('email', $email)->firstOrFail();
    }

    public function delete($id): int
    {
        return Worker::destroy($id);
    }

    public function create(WorkerEntity $worker): WorkerEntity
    {

        $workerModel = $this->mapper->mapToModel($worker, false);
        $workerModel->save();

        return $this->mapper->mapToEntity($workerModel);
    }

    public function update($id, array $attributes): bool
    {
        return Worker::whereId($id)->update($attributes);
    }
}
