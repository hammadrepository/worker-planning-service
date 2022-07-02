<?php

namespace App\Domains\Shift\Http\Controllers;

use App\Domains\Shift\Http\Mappers\UserShiftFromHTTP;
use App\Domains\Shift\Http\Requests\AssignShiftRequest;
use App\Domains\Shift\Http\Requests\UpdateAssignedShiftRequest;
use App\Domains\Shift\Http\Resources\UserShiftResource;
use App\Domains\Shift\Models\UserShift;
use App\Domains\Shift\Services\ShiftService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
//     * @return \Illuminate\Http\Response
     */
    public function assignShift(AssignShiftRequest $request)
    {

        $userShift = $this->mapper->mapEntityFromUserShiftCreate($request->all());
        return new UserShiftResource($this->shiftService->assignShift($userShift));

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
     * @return UserShiftResource
     * @throws Exception
     */
    public function updateAssignedShift(UpdateAssignedShiftRequest $request): UserShiftResource
    {
        $userShift = $this->mapper->mapEntityFromUserShiftUpdate($request->all());
        return new UserShiftResource($this->shiftService->updateShift($userShift));
    }

    /**
     * @throws Exception
     */
    public function getShiftsByDate(int $year, int $month, int $day) : array
    {
       return $this->shiftService->getShiftsByDate($year,$month,$day);
    }

    /**
     * @throws Exception
     */
    public function getShiftsByWorker($workerId) : array
    {
        return $this->shiftService->getShiftsByWorker($workerId);
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
