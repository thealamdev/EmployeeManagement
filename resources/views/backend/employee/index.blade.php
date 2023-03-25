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
                                <th>Blood Group</th>
                                <th>Actions</th>
                            </thead>
                            {{-- {{ print_r($ememployee_details) }} --}}
                            <tbody>
                                @foreach ($employee_details as $employee_detail)
                                <tr>
                                    <td>{{ $employee_detail->id }}</td>
                                    <td>{{ $employee_detail->fname . $employee_detail->lname }}</td>
                                    <td>{{ $employee_detail->employee->job_title }}</td>
                                    <td>{{ $employee_detail->employee->bloop_group }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
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