@extends('layouts.backapp')
@section('title', 'Role-List')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary"><i class="las la-plus-circle"></i></a>
                <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><i class="las la-sync"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->role }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-primary"><i
                                                    class="lar la-edit"></i></a>
                                            <a href="{{ route('admin.role.delete', $role->id) }}" class="btn btn-danger"><i
                                                    class="lar la-trash-alt"></i></a>
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
