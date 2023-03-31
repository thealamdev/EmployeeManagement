<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class AttandanceBySuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee_attandance = EmployeeAttendance::get();
        // return $employee_attandance;
        return view('backend.employee-control.index',compact('employee_attandance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee_attandance = EmployeeAttendance::where('employee_id',$request->emp_id)->get();
        // return $employee_attandance;
        return view('backend.employee-control.index',compact('employee_attandance'));
        
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
