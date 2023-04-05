@extends('layouts.backapp')
@section('title','Attandance-all')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                 <thead>
                    @for ($i=1;$i<10;$i++)
                    <th>{{ $i }}</th>
                    
                    @endfor
                     
                 </thead>
                 
                 <tbody>
                    <tr>
                        @for ($j=1; $j<10; $j++)
                        <td>{{ $j }}</td>
                        @endfor
                        
                        
                    </tr>
                 </tbody>
                 
            </table>
        </div>
    </div>
@endsection