<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\EmployeeAttendance;
use App\Models\Shift;
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
        $shift = Shift::where('employee_id',$emp_id)->first();
        // return $shift;
        return view('backend.employee-attandance.index',compact('employee','shift'));
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
        return $emp_id;

        $employee_attandance = EmployeeAttendance::create([
            'employee_id' => $emp_id,
            'present' => "Present",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
