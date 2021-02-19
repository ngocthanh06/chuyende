<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class chucvuController extends Controller
{
    private $role;

    public function __construct(Role $role) 
    {
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            $this->role->get()
        );
    }

    public function listChucVu($limit)
    {
        return response()->json(
            $this->role->paginate($limit)
        );
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
        $request->validate([ 
            'role_name' => 'unique:role', 
            'role_name.unique' => 'Tên role đã tồn tại' 
        ]);
             
        return response()->json(
            $this->role->create($request->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            $this->role->find($id)
        );
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
        $request->validate([ 
            'role_name' => 'unique:role,role_name,'.$id.',role_id', 
            'role_name.unique' => 'Tên role đã tồn tại' 
        ]);

        return response()->json(
            $this->role->find($id)->update($request->all())
        ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(
            $this->role->find($id)->delete()
        );
    }
}
