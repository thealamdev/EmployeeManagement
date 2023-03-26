<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Shift;
use App\Models\employee;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class EmployeeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee_details = employee::with(['user'=>function($q){
            $q->whereNotIn('id',[1]);
        }])->get();
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
        
        $fname = $request->fname;
        $image_name = '';
        $user_image = $request->file('photo');
        $image_name = Str::slug($fname).uniqid().".".$user_image->getClientOriginalExtension();
        
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $id =  $user->id;

        $upload_image = $user_image->move(public_path('/storage/employee/'),$image_name);
        
        $employee = employee::create([
            'user_id' => $id,
            'department_id' => $request->department_id,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'gender' => $request->gender,
            'bloop_group' => $request->blood_group,
            'photo' => $image_name,
            'nid' => $request->nid,
            'hire_date' => $request->hire_date,
            'leave_date' => $request->leave_date,
            'dob' => $request->dob,
            'note' => $request->notes
        ]);

        return redirect(route('dashboard.employee-manage.index'))->with('success','Employee Insert Successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return view('backend.employee.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee_details = employee::with('user')->where('user_id',$id)->get()->firstOrFail();
        $departments = Department::get(['id','dep_name','description']);
        return view('backend.employee.edit',compact('employee_details','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,$emp_id)
    {
        // return $user_id;
        $fname = $request->fname;
        $employee_img =  employee::where('id',$emp_id)->get('photo')->first();
        $image_name = $employee_img->photo;
        $user_image = $request->file('photo');
        if(!empty($user_image)){
            $image_name = Str::slug($fname).uniqid().".".$user_image->getClientOriginalExtension();
            $upload_image = $user_image->move(public_path('/storage/employee/'),$image_name);
        }
         
        
        $user = User::find($id);
         
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'role' => $request->role
        ]);

        $employee = employee::find($emp_id);
        // return $employee;
        $employee->update([
            'department_id' => $request->department_id,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'gender' => $request->gender,
            'bloop_group' => $request->blood_group,
            'photo' => $image_name,
            'nid' => $request->nid,
            'hire_date' => $request->hire_date,
            'leave_date' => $request->leave_date,
            'dob' => $request->dob,
            'note' => $request->notes
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


   
}
