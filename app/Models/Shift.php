<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    
 protected $guarded = [
    'id'
];

protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];
}
