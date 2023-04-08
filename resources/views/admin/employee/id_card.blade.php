@extends('layouts.backapp')
@section('title', 'Employee - ID Card')
@section('content')
    <style>
        .card_wrapper{
            background: #D8D8D8;
            /* height: 200px; */
            padding: 20px;
        }

        .card_left{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card_left img{
            border-radius:50%; 
            vertical-align: middle;
            overflow: hidden;
        }

        .card_center{
            margin-left: 10px; 
            width: 1%;
            background: #d1d1d1;
            z-index: 999999;
        }

        .card_details{
            margin-left: 10px;
        }

        .card_details h4{
            font-size: 15px;
            color: #222;
        }
    </style>
     
     <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.employee-manage.createPDF',$employee_detail->id) }}">Print</a>
        </div>
     </div>
            <div class="row">
            
                <div class="col-lg-6 m-auto mt-5">
                    <div class="card_wrapper" style="width:500px;display:flex;justify-content:space-between">
                        <div class="card_left" style="width:40%;">
                            <img src="{{ asset('/storage/employee/' .$employee_detail->photo) }}" alt="" width="100%">
                        </div>
        
                        <div class="card_center">

                        </div>
                        <div class="card_right" style="width:59%">
                            <div class="card_details">
                                <table>
                                    {!! DNS1D::getBarcodeHTML($employee_detail->if, 'CODABAR') !!}
                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Name</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->user->fname . " " .$employee_detail->user->lname }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Depertment</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->job_title }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Email</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->user->email }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Contact</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->employee_contact->phone1 }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Sex</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->gender }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Age</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ \Carbon\Carbon::parse($employee_detail->dob)->age }} {{ "Year" }}</td>
                                    </tr>

                                    <tr width="100%">
                                        <td width="45%" style="color:red;font-size:15px">Blood</td>
                                        <td width="5%" style="color:green">:</td>
                                        <td width="50%" style="color:#444">{{ $employee_detail->bloop_group }}</td>
                                    </tr>

                                    

                                    
                                </table>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
@endsection
 
