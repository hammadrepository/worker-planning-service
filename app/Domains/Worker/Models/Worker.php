<?php

namespace App\Domains\Worker\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];
}
