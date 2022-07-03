<?php

namespace App\Domains\Shift\Repositories;

use App\Domains\Shift\Enums\ShiftTypes;
use App\Domains\Shift\Models\Shift;
use App\Domains\Shift\Models\UserShift;
use App\Domains\Shift\Entity\UserShift as UserShiftEntity;
use App\Domains\Shift\Repositories\Mappers\UserShiftMapper;
use App\Domains\Worker\Models\Worker;
use App\Domains\Worker\Services\WorkerService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ShiftRepository
{
    private UserShiftMapper $userShiftMapper;
    private WorkerService $workerService;

    public function __construct(UserShiftMapper $mapper, WorkerService $workerService)
    {
        $this->userShiftMapper = $mapper;
        $this->workerService = $workerService;
    }
    public function getShiftsByDate($year, $month, $day) : array
    {
        if ($day != null && $month != null && $year != null)
        {
            $query =  UserShift::whereYear('date', '=', $year)
                ->whereMonth('date', '=', $month)
                ->whereDay('date', '=', $day)
                ->get();
        }
        $query
           ->map(function (UserShift $model){
            return $this->userShiftMapper->mapToEntity($model);
        });
        $query->map(function ($model) {
            $model->worker = collect($this->workerService->findWorkerById($model->user_id))->toArray();
        });
        return $query->toArray();
    }
    public function getShiftById($id): Shift
    {
        return Shift::findOrFail($id);
    }

    public function getWorkerShifts(int $worker_id) : array
    {
        $query =  UserShift::where([
            'user_id' => $worker_id
        ])->get();
        $query->map(function (UserShift $model){
            return $this->userShiftMapper->mapToEntity($model);
        });
        $query->map(function ($model) use ($worker_id) {
                $model->worker = collect($this->workerService->findWorkerById($worker_id))->toArray();
        });
        return $query->toArray();
    }

    public function getShiftByWorker(UserShiftEntity $shift)
    {
        return UserShift::where([
            'user_id' => $shift->worker_id,
            'date' => $shift->date
        ])->first();
    }

    public function assignShiftToWorker(UserShiftEntity $shift): UserShiftEntity
    {
        $createdShift = UserShift::create([
            'user_id' => $shift->worker_id,
            'shift_id' => $shift->shift_id,
            'shift_type' => ShiftTypes::tryFrom($this->getShiftById($shift->shift_id)->types)->value,
            'shift_start_time' => $this->getShiftById($shift->shift_id)->start_time,
            'shift_end_time' => $this->getShiftById($shift->shift_id)->end_time,
            'date' => $shift->date,
        ]);

        return $this->userShiftMapper->mapToEntity($createdShift);
    }

    public function delete($id): int
    {
        return Shift::destroy($id);
    }

    public function create(array $attributes): Shift
    {
        return Shift::create($attributes);
    }

    public function updateWorkerShift(UserShiftEntity $shift)
    {

        if(UserShift::whereId($shift->id)->update(collect($shift)->toArray())){
            $updatedShift = UserShift::whereId($shift->id)->first();
            return $this->userShiftMapper->mapToEntity($updatedShift);
        }
    }
}
