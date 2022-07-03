<?php

namespace App\Domains\Shift\Http\Controllers;

use App\Domains\Shift\Http\Mappers\UserShiftFromHTTP;
use App\Domains\Shift\Http\Requests\AssignShiftRequest;
use App\Domains\Shift\Http\Requests\UpdateAssignedShiftRequest;
use App\Domains\Shift\Http\Resources\UserShiftResource;
use App\Domains\Shift\Services\ShiftService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function __construct(
        private ShiftService      $shiftService,
        private UserShiftFromHTTP $mapper,

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Assign a shift to worker.
     *
     * @param AssignShiftRequest $request
     * @return JsonResponse
     */
    public function assignShift(AssignShiftRequest $request)
    {
        try{
            $userShift = $this->mapper->mapEntityFromUserShiftCreate($request->all());
            return $this->sendResponse( $this->shiftService->assignShift($userShift));
        }catch (Exception $e){
            return $this->sendError($e->getMessage(),$e->getTrace());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAssignedShiftRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateAssignedShift(UpdateAssignedShiftRequest $request): JsonResponse
    {
        try{
            $userShift = $this->mapper->mapEntityFromUserShiftUpdate($request->all());
            return $this->sendResponse($this->shiftService->updateShift($userShift));
        }catch (Exception $e){
            return  $this->sendError($e->getMessage(),$e->getTrace());
        }
    }

    /**
     * Get all shifts by date.
     * @param int $year
     * @param int $month
     * @param int $day
     * @return JsonResponse
     * @throws Exception
     */
    public function getShiftsByDate(int $year, int $month, int $day) : JsonResponse
    {
        try{
            return $this->sendResponse( $this->shiftService->getShiftsByDate($year,$month,$day));
        }catch (Exception $e){
            return  $this->sendError($e->getMessage(),$e->getTrace());
        }
    }

    /**
     * @param $workerId
     * @return JsonResponse
     * @throws Exception
     */
    public function getShiftsByWorker($workerId) : JsonResponse
    {
        try{
            return $this->sendResponse($this->shiftService->getShiftsByWorker($workerId));
        }catch (Exception $e){
            return $this->sendError($e->getMessage(),$e->getTrace());
        }
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
