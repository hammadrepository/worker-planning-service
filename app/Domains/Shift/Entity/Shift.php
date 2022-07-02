<?php

declare(strict_types=1);

namespace App\Domains\Shift\Entity;



use App\Domains\Shift\Enums\ShiftTypes;

class Shift
{
    public int $id;
    public ShiftTypes $type;
    public ?string $last_name;
    public ?string $email;
}
