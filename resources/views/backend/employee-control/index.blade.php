@extends('layouts.backapp')
@section('title', 'Employee - Control')
@section('content')
    <div class="card">
        <div class="card-header">
            <input type="text" id="emp_id" class="form-control">
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Present</th>
                    <th>Time</th>
                </thead>

                <tbody class="emp_add">
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

            var emp_input = document.querySelector('#emp_id')

            emp_input.addEventListener('keyup', function() {
                var emp_id = (document.querySelector('#emp_id').value)

                $.ajax({
                    type: 'GET',
                    url: "{{ route('dashboard.attandance-control.index') }}",
                    dataType: 'json',
                    data: {
                         emp_id:emp_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                       
                        console.log(data)
                        emp_detils = data.employee_attandance
                        let html = '';
                        if(emp_detils.length > 0){
                            for(let i=0;i<emp_detils.length;i++){
                                html += '<tr>\
                                            <td>'+emp_detils[i]['job_title']+'</td>\
                                            <td>'+emp_detils[i]['gender']+'</td>\
                                            <td>'+emp_detils[i]['nid']+'</td>\
                                            <td>'+emp_detils[i]['bloop_group']+'</td>\
                                         </tr>';
                            }
                        }else{
                            "nothing";
                        }

                        document.querySelector('.emp_add').innerHTML = html;
                    }

                })


            })



        });
    </script>
@endsection
