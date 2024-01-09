<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\employee;
use App\Models\EmployeeContact;
use App\Models\EmployeeEmerContact;
use App\Models\Role;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Factory;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EmployeeManageController extends Controller
{
    /**
     * @return array|object
     * Display a listing of the resource.
     */
    public function index(): array | object
    {
        $employee_details = employee::with('user', 'department')->get();
        return view('admin.employee.index', compact('employee_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id', 'dep_name', 'description']);
        $roles = Role::get();
        return view('admin.employee.create', compact('departments', 'roles'));
    }

    /**
     * @param Request $request
     * @return array|object
     * Store a newly created resource in storage.
     */
    public function store(Request $request): array | object
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
            'role' => $request->role,
        ]);

        $id = $user->id;

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
            'note' => $request->notes,
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
     * @param $id
     * @return View|Factory|Application
     * Display the specified resource.
     */
    public function show(employee $employee): View | Factory | Application
    {
        return view('admin.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee_details = employee::with('user')->with('employee_contact')->with('employee_emr_contact')->where('id', $id)->get()->firstOrFail();
        $roles = Role::get();
        $departments = Department::get(['id', 'dep_name', 'description']);
        return view('admin.employee.edit', compact('employee_details', 'departments', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $emp_id)
    {

        $employee_all = employee::where('id', $emp_id)->with('user')->with('employee_contact')->with('employee_emr_contact')->first();

        $fname = $request->fname;
        $employee_img = employee::where('id', $emp_id)->get('photo')->first();
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
            'role' => $request->role,
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
            'note' => $request->notes,
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
        // TODO implement the method.
    }

    /**
     * @param String $id
     * @return array|object
     * method for generate employee ID card
     */
    public function idCard(string $id): array | object
    {
        $employee_detail = employee::where('id', $id)->with('user', 'employee_contact')->firstOrFail();
        return view('admin.employee.id_card', compact('employee_detail'));
    }

    /**
     * @param String $id
     * @return array|object
     * method for create PDF of employee ID card
     */
    public function createPDF(string $id)
    {
        $data = employee::select('id', 'photo', 'job_title', 'gender', 'dob', 'user_id', 'bloop_group')->where('id', $id)->with('user', 'employee_contact')->firstOrFail();
        $employee_detail = $data->toArray();
        $pdf_name = $employee_detail['user']['fname'] . uniqid();
        $pdf = Pdf::loadView('admin.employee.id-card-pdf', compact('employee_detail', 'pdf_name'));
        return $pdf->download($pdf_name . '.pdf');
    }

}
