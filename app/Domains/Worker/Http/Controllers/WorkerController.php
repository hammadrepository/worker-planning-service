<?php

namespace App\Domains\Worker\Http\Controllers;

use App\Domains\Worker\Entity\Worker;
use App\Domains\Worker\Http\Mappers\WorkerMapper;
use App\Domains\Worker\Http\Requests\CreateWorkerRequest;
use App\Domains\Worker\Services\WorkerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function __construct(
        private WorkerService $workerService,
        private WorkerMapper $mapper,

    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Domains\Worker\Http\Requests\CreateWorkerRequest $request
     * @throws \Exception
     */
    public function store(CreateWorkerRequest $request)
    {
        $worker = $this->mapper->mapEntityFromCreateHttp($request->all());
        $createdWorker = $this->workerService->create($worker);

        return $createdWorker;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Worker
     */
    public function show($id)
    {
        return $this->workerService->findWorkerById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
