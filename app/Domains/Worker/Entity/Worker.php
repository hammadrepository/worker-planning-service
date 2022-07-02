<?php

declare(strict_types=1);

namespace App\Domains\Worker\Entity;



class Worker
{
    public int $id;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $email;
}
