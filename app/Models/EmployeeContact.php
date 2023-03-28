<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
    use HasFactory;
    protected $guarded =[
        'id'
    ];

    public function employee(){
        return $this->belongsTo(employee::class);
    }
}
