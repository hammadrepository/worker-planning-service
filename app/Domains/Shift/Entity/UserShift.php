<?php

declare(strict_types=1);

namespace App\Domains\Shift\Entity;



use App\Domains\Shift\Enums\ShiftTypes;
use App\Domains\Worker\Entity\Worker;
use App\Domains\Worker\Models\Worker as WorkerModel;
use Cassandra\Date;
use Cassandra\Time;

class UserShift
{
    public int $id;
    public ?int $worker_id;
    public int $shift_id;
    public ?array $worker;
    public ?ShiftTypes $shift_type;
    public string $date;
    public ?string $shift_start_time;
    public ?string $shift_end_time;
}
