<?php

namespace App\Domains\Shift\Models;

use App\Traits\hasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'types',
        'shift_start_time',
        'shift_end_time',
    ];

}
