<?php

namespace App\Domains\Worker\Http\Controllers;

use App\Domains\Worker\Entity\Worker;
use App\Domains\Worker\Http\Mappers\WorkerMapper;
use App\Domains\Worker\Http\Requests\CreateWorkerRequest;
use App\Domains\Worker\Services\WorkerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
     * @param CreateWorkerRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(CreateWorkerRequest $request) : JsonResponse
    {
        try{
            $worker = $this->mapper->mapEntityFromCreateHttp($request->all());
            $createdWorker = $this->workerService->create($worker);

            return $this->sendResponse($createdWorker,"", 201);
        }catch (\Exception $e){
           return $this->sendError($e->getMessage(),$e->getTrace());
        }
    }

    /**
     * Display the specified worker.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show($id) : JsonResponse
    {
        try{
            return $this->sendResponse($this->workerService->findWorkerById($id));
        }catch (\Exception $e){
           return $this->sendError($e->getMessage(),$e->getTrace());
        }
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
