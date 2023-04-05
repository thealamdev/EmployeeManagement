<?php

namespace App\Http\Controllers\Employee;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\employee;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;

class EmployeeAttandanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $emp_id = auth()->user()->employee->id;
        $employee = employee::where('id', $emp_id)->with(['user', 'employee_contact'])->firstOrFail();
        $shift = Shift::where('employee_id', $emp_id)->firstOrFail();
        $emp_att = EmployeeAttendance::where('employee_id', $emp_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
        
        // time {start_time, end_time and now time }
        
        $Sdate = $shift->start_time->format('Y-m-d');
        $time = date('H:i');
        $todayDate = strtotime($Sdate.' '.$time);
        $startTime = strtotime($shift->start_time);
        $endTime = strtotime($shift->end_time);
        return view('employee.attandance.index', compact(['employee', 'shift', 'emp_att','todayDate','startTime','endTime']));
    }

    public function create()
    {
        return view('employee.employee-attandance.create');
    }

    public function store(Request $request)
    {
        $emp_id = auth()->user()->employee->id;
        $employee_attandance = EmployeeAttendance::create([
            'employee_id' => $emp_id,
            'present' => "Present",
            'ip_address' => config('app.ip_address'),
        ]);

        return back()->with('success', 'Attandance Granted !!!');
    }


    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function progress()
    {
        $emp_id = auth()->user()->employee->id;
        $employee_details = EmployeeAttendance::where('employee_id', $emp_id)->with(['employee'])->get();
        // return $employee_details;
        return view('employee.attandance.progress', compact('employee_details'));
    }
}
