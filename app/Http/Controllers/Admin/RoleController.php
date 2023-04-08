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
        $roles = Role::get();
        return view('admin.role.index',compact('roles'));
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

        if($validate == false){
            return back()->with('error','Some error found !!!');
        }
    }

   

    public function edit(string $id)
    {
        $role = Role::where('id',$id)->firstOrFail();
        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //validation part:
         $validate = $request->validate([
            'role' => 'required',
            'description' => 'nullable|max:255',
        ],
        [
            'role.required' => 'Please Enter a Role',
            'description' => 'Maximum size 255',
        ]);

        if($validate == true){
            $role = Role::find($id);
            $role->update([
                'role' => $request->role,
                'description' => $request->description,
            ]);
            
            return back()->with('success','Role Update successfull');
        }

        if($validate == false){
            return back()->with('error','Some error found !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return back()->with('success','Role Delete successfull');
    }
}
