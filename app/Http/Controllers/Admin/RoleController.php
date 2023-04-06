<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation part:
        $validate = $request->validate([
            'role' => 'required|unique:roles',
            'description' => 'nullable|max:255',
        ],
        [
            'role.required' => 'Please Enter a Role',
            'role.unique' => 'Already entered',
            'description' => 'Maximum size 255',
        ]);

        if($validate == true){
            $role = Role::create([
                'role' => $request->role,
                'description' => $request->description,
            ]);
            
            return back()->with('success','Role Insert successfull');
        }
        else{
            return back()->with('error','Some error found !!!');
        }
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
