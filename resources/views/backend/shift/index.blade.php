@extends('layouts.backapp')
@section('title','Shift List')
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
                                <th>Shift Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($shifts as $shift)
                                <tr>
                                    <td>{{ $shift->id }}</td>
                                    <td>{{ $shift->shift_name }}</td>
                                    <td>{{ Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                                    <td>{{ Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
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