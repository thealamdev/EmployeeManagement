@extends('layouts.backapp')
@section('title', 'Employee Edit')
@section('content')
    <style>
        body {
            margin-top: 40px;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.employee-manage.index') }}">Create</a>
        </div>
    </div>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    @include('message')
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle"  >2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle"  >3</a>
                    <p>Step 3</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle"  >4</a>
                    <p>Step 4</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle"  >5</a>
                    <p>Step 5</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-6" type="button" class="btn btn-default btn-circle"  >6</a>
                    <p>Step 6</p>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.employee-manage.update', $employee_details->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 1</h3>
                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->user->fname }}" name="fname" required="required" class="form-control"
                                placeholder="Enter First Name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->user->lname }}" name="lname" required="required" class="form-control"
                                placeholder="Enter Last Name" />
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Employee Role</label>
                            <select name="role" id="role" class="form-control">
                                <option selected disabled>Select user Role</option>
                                @foreach ($roles as $role)
                                <option @if ($employee_details->user->role == $role->role)
                                    {{ 'selected' }}
                                @endif value="{{ $role->role }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 2</h3>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Image</label>
                            <input type="file" name="photo" class="form-control"
                                placeholder="Enter Employee image" />
                            <img src="{{ asset('storage/employee/'.$employee_details->photo) }}" alt="" width="50">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Department</label>
                            <select name="department_id" id="department" class="form-control">
                                <option selected disabled>Select Department</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @if ($department->id == $employee_details->department_id)
                                    {{ "selected" }}
                                @endif>{{ $department->dep_name }}</option>
                                @endforeach
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Date of Birth</label>
                            <input maxlength="200" value="{{ $employee_details->dob->format('Y-m-d') }}" type="date" name="dob" required="required" class="form-control"
                                 />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Job title</label>
                            <input maxlength="200" value="{{ $employee_details->job_title }}" type="text" name="job_title" required="required"
                                class="form-control" placeholder="Enter job title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter job description</label>
                            <textarea name="job_description" id="" cols="30" rows="4" class="form-control"
                                placeholder="Enter job description">{{ $employee_details->job_description }}</textarea>
                        </div>

                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 3</h3>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" value="Male" type="radio" name="gender" id="gender" @if ($employee_details->gender == 'Male')
                                    {{ "checked" }}
                                @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Female" type="radio" name="gender" id="gender"
                                @if ($employee_details->gender == 'Female')
                                {{ "checked" }}
                            @endif>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Others" type="radio" name="gender" id="gender"
                                @if ($employee_details->gender == 'Others')
                                {{ "checked" }}
                            @endif >
                                <label class="form-check-label" for="gender">
                                    Others
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee NID</label>
                            <input maxlength="100" type="text" name="nid" value="{{ $employee_details->nid }}"
                                class="form-control" placeholder="Enter Employee NID Number" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Blood Group</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->bloop_group }}" name="blood_group" required="required"
                                class="form-control" placeholder="Enter Employee Blood Group" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Joining Date</label>
                            <input maxlength="100" type="date" value="{{ $employee_details->hire_date->format('Y-m-d') }}" name="hire_date" required="required"
                                class="form-control" placeholder="Enter Joining Date" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Leaving Day(Not required)</label>
                            <input maxlength="100" type="date" @if ($employee_details->leave_date)
                            value="{{ $employee_details->leave_date->format('Y-m-d') }}"
                            @endif name="leave_date"
                                class="form-control" placeholder="Enter Leaving Date" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>

            <div class="row setup-content" id="step-4">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 3</h3>
                        <div class="form-group">
                            <label class="control-label">Enter job Notes</label>
                            <textarea name="notes" cols="30" rows="4" class="form-control"
                                placeholder="Enter job Notes">{{ $employee_details->note }}</textarea>
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>

            <div class="row setup-content" id="step-5">
                <div class="col-xs-6">
                    <div class="col-md-12">
                        <h3> Step 5</h3>
                        <div class="form-group">
                            <label class="control-label">Employee phone Number 1</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_contact->phone1 }}" name="phone1" required="required" class="form-control"
                                placeholder="Enter phone 1" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee phone Number 2</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_contact->phone2 }}" name="phone2" required="required" class="form-control"
                                placeholder="Enter phone 2" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Email 2</label>
                            <input maxlength="100" type="email" value="{{ $employee_details->employee_contact->email2 }}" name="email2" required="required" class="form-control"
                                placeholder="Enter employee email 2" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Address</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_contact->address }}" name="address" required="required" class="form-control"
                                placeholder="Enter employee address" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee City</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_contact->city }}" name="city" required="required" class="form-control"
                                placeholder="Enter Employee city" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Zip</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_contact->zip }}" name="zip" required="required" class="form-control"
                                placeholder="Enter Employee zip" />
                        </div>
                         
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="col-md-12">
                        <h3>Emergency Contact</h3>
                        <div class="form-group">
                            <label class="control-label">Relative's Full Name</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->fullname }}" name="fullname" class="form-control"
                                placeholder="Enter Full Name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Relationship</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->relationship }}" name="relationship" class="form-control"
                                placeholder="Enter Relationship" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Relative Email</label>
                            <input maxlength="100" type="email" value="{{ $employee_details->employee_emr_contact->email }}" name="rel_email"  class="form-control"
                                placeholder="Enter relative's email" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Relative's Phone</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->phone }}" name="rel_phone" required="required" class="form-control"
                                placeholder="Enter Relative's Phone " />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Address</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->address }}" name="rel_address" required="required" class="form-control"
                                placeholder="Enter Employee Role" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Employee Relative's City</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->city }}" name="rel_city" required="required" class="form-control"
                                placeholder="Enter Employee Role" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Employee Relative's Zip</label>
                            <input maxlength="100" type="text" value="{{ $employee_details->employee_emr_contact->zip }}" name="rel_zip"  class="form-control"
                                placeholder="Enter Employee's Relative Zip" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            
            <div class="row setup-content" id="step-6">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3>Step 5</h3>
                        <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- <form action="{{ route('dashboard.employee-manage.update',[$employee_details->user->id,$employee_details->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 1</h3>
                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input maxlength="100" type="text" name="fname" required="required" class="form-control"
                                placeholder="Enter First Name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input maxlength="100" type="text" name="lname" required="required" class="form-control"
                                placeholder="Enter Last Name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Email</label>
                            <input maxlength="100" type="email" name="email" required="required" class="form-control"
                                placeholder="Enter employee email" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Password</label>
                            <input maxlength="100" type="password" name="password" required="required" class="form-control"
                                placeholder="Enter employee password" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Role</label>
                            <input maxlength="100" type="text" name="role" required="required" class="form-control"
                                placeholder="Enter Employee Role" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 2</h3>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Image</label>
                            <input type="file" name="photo" class="form-control"
                                placeholder="Enter Employee image" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Department</label>
                            <select name="department_id" id="department" class="form-control">
                                <option selected disabled>Select Department</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->dep_name }}</option>
                                @endforeach
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Date of Birth</label>
                            <input maxlength="200" type="date" name="dob" required="required" class="form-control"
                                placeholder="Enter employee's dob" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Job title</label>
                            <input maxlength="200" type="text" name="job_title" required="required"
                                class="form-control" placeholder="Enter job title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter job description</label>
                            <textarea name="job_description" id="" cols="30" rows="4" class="form-control"
                                placeholder="Enter job description"></textarea>
                        </div>

                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 3</h3>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" value="Male" type="radio" name="gender" id="gender">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Female" type="radio" name="gender" id="gender"
                                    >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Others" type="radio" name="gender" id="gender"
                                    >
                                <label class="form-check-label" for="gender">
                                    Others
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee NID</label>
                            <input maxlength="100" type="text" name="nid" required="required"
                                class="form-control" placeholder="Enter Employee NID Number" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Blood Group</label>
                            <input maxlength="100" type="text" name="blood_group" required="required"
                                class="form-control" placeholder="Enter Employee Blood Group" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Employee Joining Date</label>
                            <input maxlength="100" type="date" name="hire_date" required="required"
                                class="form-control" placeholder="Enter Joining Date" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter Leaving Day(Not required)</label>
                            <input maxlength="100" type="date" name="leave_date"
                                class="form-control" placeholder="Enter Leaving Date" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>

            <div class="row setup-content" id="step-4">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3> Step 4</h3>
                        <div class="form-group">
                            <label class="control-label">Enter job description</label>
                            <textarea name="notes" cols="30" rows="4" class="form-control"
                                placeholder="Enter job Notes"></textarea>
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-5">
                <div class="col-xs-6">
                    <div class="col-md-12">
                        <h3> Step 5</h3>
                        <div class="form-group">
                            <label class="control-label">Employee phone Number 1</label>
                            <input maxlength="100" type="text" name="phone1" required="required" class="form-control"
                                placeholder="Enter phone 1" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee phone Number 2</label>
                            <input maxlength="100" type="text" name="phone2" required="required" class="form-control"
                                placeholder="Enter phone 2" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Email 2</label>
                            <input maxlength="100" type="email" name="email2" required="required" class="form-control"
                                placeholder="Enter employee email 2" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Address</label>
                            <input maxlength="100" type="text" name="address" required="required" class="form-control"
                                placeholder="Enter employee address" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee City</label>
                            <input maxlength="100" type="text" name="city" required="required" class="form-control"
                                placeholder="Enter Employee city" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Zip</label>
                            <input maxlength="100" type="text" name="zip" required="required" class="form-control"
                                placeholder="Enter Employee zip" />
                        </div>
                         
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="col-md-12">
                        <h3>Emergency Contact</h3>
                        <div class="form-group">
                            <label class="control-label">Relative's Full Name</label>
                            <input maxlength="100" type="text" name="fullname" class="form-control"
                                placeholder="Enter Full Name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Relationship</label>
                            <input maxlength="100" type="text" name="relationship" class="form-control"
                                placeholder="Enter Relationship" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Relative Email</label>
                            <input maxlength="100" type="email" name="rel_email"  class="form-control"
                                placeholder="Enter relative's email" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Relative's Phone</label>
                            <input maxlength="100" type="text" name="rel_phone" required="required" class="form-control"
                                placeholder="Enter Relative's Phone " />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employee Address</label>
                            <input maxlength="100" type="text" name="rel_address" required="required" class="form-control"
                                placeholder="Enter Employee Role" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Employee Relative's City</label>
                            <input maxlength="100" type="text" name="rel_city" required="required" class="form-control"
                                placeholder="Enter Employee Role" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Employee Relative's Zip</label>
                            <input maxlength="100" type="text" name="rel_zip"  class="form-control"
                                placeholder="Enter Employee's Relative Zip" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            
            <div class="row setup-content" id="step-6">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3>Step 6</h3>
                        <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
                    </div>
                </div>
            </div>
        </form> --}}
    </div>
@endsection

@section('js')
    <script>
        
        $(document).ready(function() {

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function(e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function() {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                    .children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
    </script>
@endsection
