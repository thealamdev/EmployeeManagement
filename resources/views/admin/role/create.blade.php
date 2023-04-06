@extends('layouts.backapp')
@section('title', 'Role Create')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary"><i class="las la-sync"></i></a>
                <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><i class="las la-list-ul"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shift_name" class="form-label">Role Name</label>
                                <input type="text" name="role"
                                    class="form-control @error('role')
                                    {{ 'alert alert-danger' }}
                                @enderror"
                                    aria-describedby="emailHelp">
                                @error('role')
                                    <div id="error" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                    class="form-control @error('description')
                                {{ 'alert alert-danger' }}
                                @enderror"
                                    name="description" cols="30" rows="5"></textarea>
                                @error('description')
                                    <div id="error" class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
