<?php

namespace App\Domains\Shift\Services;


use App\Domains\Shift\Entity\Shift;
use App\Domains\Shift\Entity\UserShift;
use App\Domains\Shift\Repositories\ShiftRepository;
use Illuminate\Support\Carbon;

class ShiftService
{
    public function __construct(
        private ShiftRepository $shiftRepository,
    ){}

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getShiftsByDate(int $year,int $month,int $day) : array
    {
        return  $this->shiftRepository->getShiftsByDate($year,$month,$day);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getShiftsByWorker($workerId) : array
    {
        return  $this->shiftRepository->getWorkerShifts($workerId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function assignShift(UserShift $shift) : UserShift
    {
        $this->validateShift($shift);
        return  $this->shiftRepository->assignShiftToWorker($shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function updateShift(UserShift $shift) : UserShift
    {
        return $this->shiftRepository->updateWorkerShift($shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @throws \Exception
     */
    public function validateShift(UserShift $shift)
    {
        $userShift = $this->shiftRepository->getShiftByWorker($shift);

        if($userShift && $userShift->date == $shift->date){
            return throw new \Exception("Shift is already assigned on this date");
        }

    }
}
