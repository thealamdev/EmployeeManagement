<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee_details = User::with('employee')->whereNotIn('id',[1])->get();
        // return $employee_details;
        return view('backend.employee.index',compact('employee_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id','dep_name','description']);
        // return $departments;
        return view('backend.employee.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $id = DB::table('users')->latest()->value('id');

        $employee = employee::create([
            'user_id' => $id,
            'department_id' => $request->department_id,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'gender' => $request->gender,
            'bloop_group' => $request->blood_group,
            'photo' => "3e4sdc",
            'hire_date' => $request->hire_date,
            'leave_date' => $request->leave_date,
            'dob' => $request->dob,
            'note' => $request->notes
        ]);

        return back()->with('success','Employee Insert Successfull');
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
