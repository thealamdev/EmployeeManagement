@extends('layouts.backapp')
@section('title', 'Employee - Control')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-2">
                    Search: <input type="text" id="emp_id" class="form-control">
                </div>

                <div class="col-lg-10">
                    <form action="{{ route('dashboard.attandance-control.dateFilter') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-lg-4">
                                Start Date:<input type="date" class="form-control" name="start_date">
                            </div>
                            <div class="col-lg-4">
                                End Date:<input type="date" class="form-control" name="end_date">
                            </div>
                            <div class="col-lg-4">
                                <div class="buttons mt-3">
                                    <button type="submit" class="btn btn-info">Search</button>
                                    <a href="{{ route('dashboard.attandance-control.index') }}"
                                        class="btn btn-danger">Refresh</a>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

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
                $emp_id = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: "{{ route('dashboard.attandance-control.index') }}",
                    dataType: 'json',
                    data: {
                        emp_id: $emp_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        console.log(data)
                        emp_detils = data.employee_attandance
                        let html = '';
                        if (emp_detils.length > 0) {
                            for (let i = 0; i < emp_detils.length; i++) {
                                html += '<tr>\
                                                    <td>' + emp_detils[i]['employee_attandance'][i]['created_at'] + '</td>\
                                                    <td>' + emp_detils[i]['user']['fname'] +" "+ emp_detils[i]['user']['lname'] + '</td>\
                                                    <td>' + emp_detils[i]['nid'] + '</td>\
                                                    <td>' + emp_detils[i]['bloop_group'] + '</td>\
                                                 </tr>';
                            }
                        } else {
                            "nothing";
                        }

                        document.querySelector('.emp_add').innerHTML = html;
                    }

                })


            })



        });
    </script>
@endsection
