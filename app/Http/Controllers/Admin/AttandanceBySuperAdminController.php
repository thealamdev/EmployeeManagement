<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\employee;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AttandanceBySuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // return Route::currentRouteName();
        if ($request->ajax()) {
            $employee_attandance = employee::where('job_title', 'LIKE', '%' . $request->keyword . '%')->get();
            // ->with(['user','employee_attandance'])
            //     ->orWhere('id', '=', $request->keyword)
            //     ->get();
            return response()->json(['employee_attandance' => $employee_attandance]);

        } elseif (Route::currentRouteName() == 'admin.attandance-control.index') {
            $employee_attandance = EmployeeAttendance::with('employee')->get();
            return view('admin.employee-control.index', compact('employee_attandance'));
        }
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


        $employee_attandance = EmployeeAttendance::where('employee_id', $request->emp_id)->get();
        return view('admin.employee-control.index', compact('employee_attandance'));
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

    public function dateFilter(Request $request)
    {
        $employee_attandance = EmployeeAttendance::with('employee')->whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        // return $employee_attandance;
        return view('admin.employee-control.index', compact('employee_attandance'));
    }

    public function attandance(){
        return view('employee.attandance.attandance');
    }
}
