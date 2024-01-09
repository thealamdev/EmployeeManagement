@extends('layouts.backapp')
@section('title', 'Employee List')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.employee-manage.create') }}" class="btn btn-primary"><i
                        class="las la-plus-circle"></i></a>
                <a href="{{ route('admin.employee-manage.index') }}" class="btn btn-primary"><i class="las la-sync"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Blood Group</th>
                                <th style="text-align: center">Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($employee_details as $employee_detail)
                                    <tr>
                                        <td>
                                            <a title="{{ $employee_detail->user->fname . ' ' . $employee_detail->user->lname . "'s ID" }}"
                                                href="{{ route('admin.employee-manage.idcard', $employee_detail->id) }}">
                                                <img src="{{ asset('/storage/employee/' . $employee_detail->photo) }}"
                                                    width="50" style="border-radius: 50%" height="50"
                                                    alt=""></a>
                                        </td>
                                        <td>{{ $employee_detail->user->fname . ' ' . $employee_detail->user->lname }}</td>
                                        <td>{{ $employee_detail->department->dep_name }}</td>
                                        <td>{{ $employee_detail->user->role }}</td>
                                        <td>{{ $employee_detail->bloop_group }}</td>
                                        <td>
                                            <a title="{{ 'Add Shift' }}"
                                                href="{{ route('admin.shift.create', $employee_detail->id) }}"
                                                class="btn btn-secondary"><i class="las la-plus-circle"></i>
                                            </a>

                                            <a title="{{ 'Edit' }}"
                                                href="{{ route('admin.employee-manage.edit', $employee_detail->id) }}"
                                                class="btn btn-primary"><i class="las la-user-edit"></i>
                                            </a>

                                            <a href="#" class="btn btn-danger"><i class="lar la-trash-alt"></i></a>

                                            <a title="{{ 'View Details' }}"
                                                href="{{ route('admin.employee-manage.show', $employee_detail->id) }}"
                                                class="btn btn-success"><i class="las la-eye"></i>
                                            </a>
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
