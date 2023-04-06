<?php

namespace App\Models;

use App\Models\EmployeeEmerContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employee_contact(){
        return $this->hasOne(EmployeeContact::class);
    }

    public function employee_emr_contact(){
        return $this->hasOne(EmployeeEmerContact::class);
    }

    public function shift(){
        return $this->hasOne(Shift::class);
    }

    public function employee_attandance(){
        return $this->hasMany(EmployeeAttendance::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

}
