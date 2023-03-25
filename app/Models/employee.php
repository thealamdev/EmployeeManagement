<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $guarded =[
        'id'
    ];

    protected $casts = [
        'dob' => 'datetime',
        'hire_date' => 'datetime',
        'leave_date' => 'datetime',
    ];
}
