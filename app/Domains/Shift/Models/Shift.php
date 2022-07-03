<?php

namespace App\Domains\Shift\Models;

use App\Traits\hasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
        'shift_type',
        'shift_start_time',
        'shift_end_time',
        'date'
    ];
}
