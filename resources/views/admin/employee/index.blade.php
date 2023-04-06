@extends('layouts.backapp')
@section('title','Employee List')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary">Create</a>
                <a href="#" class="btn btn-primary">List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Role</th>
                                <th>Blood Group</th>
                                <th>Actions</th>
                            </thead>
                             
                            <tbody>
                                @foreach ($employee_details as $employee_detail)
                                <tr>
                                    <td>{{ $employee_detail->id }}</td>
                                    <td>{{ $employee_detail->user->fname ." ". $employee_detail->user->lname }}</td>
                                    <td>{{ $employee_detail->job_title }}</td>
                                    <td>{{ $employee_detail->user->role }}</td>
                                    <td>{{ $employee_detail->bloop_group }}</td>
                                    <td>
                                        <a href="{{ route('admin.shift.create',$employee_detail->id) }}" class="btn btn-secondary"><i class="las la-plus-circle"></i></a>
                                        <a href="{{ route('admin.employee-manage.edit',$employee_detail->id) }}" class="btn btn-primary"><i class="las la-user-edit"></i></a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                        <a href="{{ route('admin.employee-manage.show',$employee_detail->id) }}" class="btn btn-success"><i class="las la-eye"></i></a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection