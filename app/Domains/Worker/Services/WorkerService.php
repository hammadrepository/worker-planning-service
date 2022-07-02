<?php

namespace App\Domains\Worker\Services;


use App\Domains\Worker\Entity\Worker;
use App\Domains\Worker\Repositories\WorkerRepository;

class WorkerService
{
    public function __construct(
        private WorkerRepository $workerRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function create(Worker $worker): Worker
    {
        if (isset($worker->email) && $this->workerRepository->findByEmail($worker->email)) {
            throw new \Exception('Worker with the same email already registered',409);
        }
        $createdWorker = $this->workerRepository->create($worker);

        return $worker;
    }

    public function findWorkerById(int $id) : ?Worker
    {
        return $this->workerRepository->getById($id);
    }
}
