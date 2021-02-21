<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\CompanyInterface;
use Validator;

class CompanyController extends Controller
{
    private $company ;

    public function __construct(CompanyInterface $company)
    {
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->company->getAll();
    }

    /*
    * 
    */

    public function getLimit($limit)
    {
        return $this->company->getLimit($limit); 
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

    public function getChiNhanh($id)
    {
        return $this->company->getChiNhanh($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['nameComp' => 'unique:companies'],
            ['nameComp.unique' => 'Tên chi nhánh đã tồn tại']
        );

        return $this->company->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request['id'] = $id;
        $request->validate(
            ['nameComp' => 'unique:companies,nameComp,'.$id.',idComp'],
            ['nameComp.unique' => 'Tên chi nhánh đã tồn tại']
        );
        
        return $this->company->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->company->destroy($id);
    }
}
