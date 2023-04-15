<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pdf_name . ".pdf" }}</title>

    <style>
        body{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center
        }
        .card_wrapper {
            background: #D8D8D8;
            padding: 20px;
        }

        .card_left {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card_left img {
            border-radius: 50%;
            vertical-align: middle;
            overflow: hidden;
        }

        .card_center {
            margin-left: 10px;
            width: 1%;
            background: #d1d1d1;
            z-index: 999999;
        }

        .card_details {
            margin-left: 10px;
        }

        .card_details h4 {
            font-size: 15px;
            color: #222;
        }
    </style>
</head>

<body>
            <div class="card_wrapper" style="width:500px;display:flex;justify-content:space-between">
                <div class="card_left" style="width:40%;">
                    <img src="{{ public_path('/storage/employee/' .$employee_detail['photo']) }}" width="50%" style="border-radius: 100%" alt="">
                </div>

                <div class="card_center">

                </div>
                <div class="card_right" style="width:59%">
                    <div class="card_details">
                        <table>
                            {!! DNS1D::getBarcodeHTML($employee_detail['id'], 'CODABAR') !!}
                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Name</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">
                                    {{ $employee_detail['user']['fname'] . ' ' . $employee_detail['user']['lname'] }}
                                </td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Depertment</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">{{ $employee_detail['job_title'] }}</td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Email</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">{{ $employee_detail['user']['email'] }}</td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Contact</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">
                                    {{ $employee_detail['employee_contact']['phone1'] }}</td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Sex</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">{{ $employee_detail['gender'] }}</td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Age</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">
                                    {{ \Carbon\Carbon::parse($employee_detail['dob'])->age }} {{ 'Year' }}</td>
                            </tr>

                            <tr width="100%">
                                <td width="45%" style="color:red;font-size:15px">Blood</td>
                                <td width="5%" style="color:green">:</td>
                                <td width="50%" style="color:#444">{{ $employee_detail['bloop_group'] }}</td>
                            </tr>




                        </table>

                    </div>
                </div>
            </div>
</body>

</html>
