@extends('layouts.backapp')
@section('title', 'Shift Create')
@section('content')
    <div class="container">
  
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary">List</a>
                <a class="btn btn-primary" href="{{ route('dashboard.employee-manage.index') }}">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                     
                    <div class="col-lg-6 m-auto">
                        @if (!empty($shift->user_id))
                         <h3>{{ "Shift already Exist" }}</h3>
                        @endif 
                        <form action="{{ route('dashboard.shift.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $employee->id }}">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Employee Name</label>
                                <input type="text" disabled value="{{ $employee->fname. " ". $employee->lname }}" class="form-control" id="id"
                                    aria-describedby="emailHelp">
                                <div id="error" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="shift_name" class="form-label">Shift Name</label>
                                <input type="text" name="shift_name" class="form-control" id="shift_name" @if (!empty($shift->user_id))
                                 {{ "disabled" }}
                                @endif 
                                    aria-describedby="emailHelp">
                                <div id="error" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Shift Start Time</label>
                                <input type="time" name="start_time" @if (!empty($shift->user_id))
                                {{ "disabled" }}
                               @endif  class="form-control" id="start_time">
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Shift End Time</label>
                                <input type="time" name="end_time" @if (!empty($shift->user_id))
                                {{ "disabled" }}
                               @endif  class="form-control" id="end_time">
                            </div>
                            

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
