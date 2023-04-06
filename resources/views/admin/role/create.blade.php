@extends('layouts.backapp')
@section('title', 'Role Create')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Fresh</a>
                <a href="{{ route('admin.role.index') }}" class="btn btn-primary">List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shift_name" class="form-label">Role Name</label>
                                <input type="text" name="role" class="form-control"
                                    aria-describedby="emailHelp">
                                <div id="error" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
