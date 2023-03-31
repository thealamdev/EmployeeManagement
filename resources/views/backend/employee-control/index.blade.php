@extends('layouts.backapp')
@section('title', 'Employee - Control')
@section('content')
    <div class="card">
        <div class="card-header">
            <form id="emp_search_form">
                @csrf
                <input type="text" id="emp_id" class="form-control">
                <br>
                <button type="button" id="emp_sumbit" class="btn btn-success">Search</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Present</th>
                    <th>Time</th>
                </thead>

                <tbody>
                    @foreach ($employee_attandance as $emp_att)
                        <tr>
                            <td>{{ $emp_att->created_at->format('d-m-Y') }}</td>
                            <td>{{ $emp_att->employee->user->fname . ' ' . $emp_att->employee->user->lname }}</td>
                            <td>{{ $emp_att->present }}</td>
                            <td>{{ $emp_att->created_at->format('h:i A') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('js')
    <script>

        $(document).ready(function() {
            var emp_submit = document.querySelector('#emp_submit');
            var emp_id = document.querySelector('#emp_id').value;

            emp_sumbit.addEventListener('click',function(){
                console.log(emp_id)
            })
             
        });
         
            
        
    </script>
@endsection
