@extends('layouts.backapp')
@section('title', 'Department Create')
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
                        <form action="{{ route('dashboard.department.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shift_name" class="form-label">Department Name</label>
                                <input type="text" name="dep_name" class="form-control" id="shift_name"
                                    aria-describedby="emailHelp">
                                <div id="error" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                 <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                             

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
