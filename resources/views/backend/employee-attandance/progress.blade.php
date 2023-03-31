@extends('layouts.user-backapp')
@section('title','Attandance-Progress')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Attandance</th>
                    <th>Time</th>
                    <th>Late</th>
                    
                </thead>

                <tbody>
                    @foreach ($employee_details as $employee_detail)
                    <tr>
                        <td>{{ $employee_detail->created_at->format('d-m-Y') }}</td>
                        <td>{{ $employee_detail->employee->user->fname . " ". $employee_detail->employee->user->lname }}</td>
                        <td>{{ $employee_detail->present }}</td>
                        <td>{{ $employee_detail->created_at->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($employee_detail->created_at)->format('H:i') }} - {{ $employee_detail->employee->shift->start_time->format('H:i') }} ({{ \Carbon\Carbon::parse($employee_detail->created_at)->diffInMinutes($employee_detail->employee->shift->start_time) }} minutes)
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
