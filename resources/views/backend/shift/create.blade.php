@extends('layouts.backapp')
@section('title', 'Shift Create')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary">Create</a>
                <a href="#" class="btn btn-primary">List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <form action="{{ route('dashboard.shift.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shift_name" class="form-label">Shift Name</label>
                                <input type="text" name="shift_name" class="form-control" id="shift_name"
                                    aria-describedby="emailHelp">
                                <div id="error" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Shift Start Time</label>
                                <input type="time" name="start_time" class="form-control" id="start_time">
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Shift End Time</label>
                                <input type="time" name="end_time" class="form-control" id="end_time">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Shift Description</label>
                                 <textarea name="description" id="description" cols="30" rows="5" class="form-control"> </textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
