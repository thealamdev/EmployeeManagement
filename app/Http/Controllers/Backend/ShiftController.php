<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\employee;

use function PHPUnit\Framework\isEmpty;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::get();
        // return $shifts;
        return view('backend.shift.index',compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
         
        $employee = employee::with(['user'=>function($q){
            $q->select(['id','fname','lname']);
        }])->where('id',$id)->firstOrFail();
        // return $employee;
        $shift = Shift::get('id')->where('id',$id)->first();
        // return $shift;
        
        return view('backend.shift.create',compact('employee','shift'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shift = Shift::create([
            'employee_id' => $request->employee_id,
            'shift_name' => $request->shift_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success','Shift inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
