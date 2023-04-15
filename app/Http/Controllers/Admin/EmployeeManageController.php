<?php

namespace App\Http\Controllers\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Role;
use App\Models\User;
use App\Models\Shift;
use App\Models\employee;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmployeeContact;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeEmerContact;
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
        $employee_details = employee::with('user','department')->get();
        // return $employee_details;
        return view('admin.employee.index', compact('employee_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id', 'dep_name', 'description']);
        $roles = Role::get();
        return view('admin.employee.create', compact('departments','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fname = $request->fname;
        $image_name = '';
        $user_image = $request->file('photo');
        $image_name = Str::slug($fname) . uniqid() . "." . $user_image->getClientOriginalExtension();

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $id =  $user->id;

        $upload_image = $user_image->move(public_path('/storage/employee/'), $image_name);

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

        $employee_id = $employee->id;
        $employee_contact = EmployeeContact::create([
            'employee_id' => $employee_id,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email2' => $request->email2,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
        ]);


        $employee_emr_contact = EmployeeEmerContact::create([
            'employee_id' => $employee_id,
            'fullname' => $request->fullname,
            'relationship' => $request->relationship,
            'phone' => $request->rel_phone,
            'email' => $request->rel_email,
            'address' => $request->rel_address,
            'city' => $request->rel_city,
            'zip' => $request->rel_zip,
        ]);

        return redirect(route('admin.employee-manage.index'))->with('success', 'Employee Insert Successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.employee.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee_details = employee::with('user')->with('employee_contact')->with('employee_emr_contact')->where('id', $id)->get()->firstOrFail();
        $roles = Role::get();
        $departments = Department::get(['id', 'dep_name', 'description']);
        return view('admin.employee.edit', compact('employee_details', 'departments','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $emp_id)
    {
        $employee_all = employee::where('id', $emp_id)->with('user')->with('employee_contact')->with('employee_emr_contact')->first();

        $fname = $request->fname;
        $employee_img =  employee::where('id', $emp_id)->get('photo')->first();
        $image_name = $employee_img->photo;
        $user_image = $request->file('photo');
        if (!empty($user_image)) {
            $image_name = Str::slug($fname) . uniqid() . "." . $user_image->getClientOriginalExtension();
            $upload_image = $user_image->move(public_path('/storage/employee/'), $image_name);
        }

        $user_m_id = $employee_all->user->id;
        $user = User::find($user_m_id);

        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'role' => $request->role
        ]);

        $employe_m_id = $employee_all->id;
        $employee = employee::find($employe_m_id);

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


        $employee_contact_id = $employee_all->employee_contact->id;
        $employee_contact = EmployeeContact::find($employee_contact_id);

        $employee_contact->update([
            'employee_id' => $employee->id,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email2' => $request->email2,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
        ]);

        $employee_emr_contact_id = $employee_all->employee_emr_contact->id;
        $employee_emr_contact = EmployeeEmerContact::find($employee_emr_contact_id);

        $employee_emr_contact->update([
            'employee_id' => $employee->id,
            'fullname' => $request->fullname,
            'relationship' => $request->relationship,
            'phone' => $request->rel_phone,
            'email' => $request->rel_email,
            'address' => $request->rel_address,
            'city' => $request->rel_city,
            'zip' => $request->rel_zip,
        ]);

        return redirect(route('admin.employee-manage.index'))->with('success', 'Employee Update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Employee ID Card Generator:
    public function idCard(string $id){
        $employee_detail = employee::where('id',$id)->with('user','employee_contact')->firstOrFail();
        // return $employee_detail;
        return view('admin.employee.id_card',compact('employee_detail'));
    }

    public function createPDF(string $id) {
        $data = employee::select('id','photo','job_title','gender','dob','user_id','bloop_group')->where('id',$id)->with('user','employee_contact')->firstOrFail();
        $employee_detail = $data->toArray();
        // return $employee_detail;
 
        $pdf_name = $employee_detail['user']['fname'].uniqid();
        $pdf = Pdf::loadView('admin.employee.id-card-pdf', compact('employee_detail','pdf_name'));
        return $pdf->download($pdf_name.'.pdf');
    }
    
}
