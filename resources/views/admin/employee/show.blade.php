@extends('layouts.backapp')
@section('title', 'Employee - show')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <label for="title">Employee Show</label>
                </div>

                <div class="card-body">
                    {{ $employee->user->fname . ' ' . $employee->user->lname }}
                    <img src="{{ asset('/storage/employee/' . $employee->photo) }}"
                        alt="{{ asset('/storage/employee/' . $employee->photo) }}" width="100">
                    {{ $employee->department }}
                    {{ $employee->shift }}
                    {{-- {{ $employee->employee_contact }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
