<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class chucvuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return Role::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'Role_name' => 'unique:role',
        ], [
            'Role_name.unique' => 'Tên role đã tồn tại'
        ]);
        $role = new Role();
        $role['coefficient'] = $request['coefficient'];
        $role['price'] = $request['price'];
        $role['Role_name'] = $request['Role_name'];
        $role['Role_desc'] = $request['Role_desc'];
        $role->save();        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Role::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role['coefficient'] = $request['coefficient'];
        $role['price'] = $request['price'];
        $role['Role_name'] = $request['Role_name'];
        $role['Role_desc'] = $request['Role_desc'];
        $role->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
