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
                                            <form action="{{ route('admin.role.delete',$role->id) }}" style="display: inline-block" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button"  class="btn btn-danger sub_btn"><i
                                                    class="lar la-trash-alt"></i></button>
                                            </form>
                                             
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

@section('js')
    <script>
        $sub_btn = $('.sub_btn');
        $sub_btn.on('click',function(){
            if( confirm("Would you like to delete it ???")){
                this.form.submit();
                // $sub_btn.closest('form').submit()
            }else{
                alert("not ok")
            }
            
        })
    </script>
@endsection