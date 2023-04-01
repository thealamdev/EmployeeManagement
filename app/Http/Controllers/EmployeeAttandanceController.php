<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\EmployeeAttendance;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeAttandanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emp_id = auth()->user()->employee->id;
        $employee = employee::where('id',$emp_id)->with(['user','employee_contact'])->firstOrFail();
        $shift = Shift::where('employee_id',$emp_id)->firstOrFail();
        $emp_att = EmployeeAttendance::where('employee_id',$emp_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
        
        
        // return Carbon::today()->toDateString();
        return view('backend.employee-attandance.index',compact(['employee','shift','emp_att']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.employee-attandance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $emp_id = auth()->user()->employee->id;
        $employee_attandance = EmployeeAttendance::create([
            'employee_id' => $emp_id,
            'present' => "Present",
            'ip_address' => config('app.ip_address'),
        ]);

        return back()->with('success','Attandance Done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function progress(){
        $emp_id = auth()->user()->employee->id;
        $employee_details = EmployeeAttendance::where('employee_id',$emp_id)->with(['employee'])->get();
        // return $employee_details;
        return view('backend.employee-attandance.progress',compact('employee_details'));
    }
}
