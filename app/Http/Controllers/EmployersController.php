<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Repositories\TodoInterfaceWork\SupportInterface;
use App\Http\Requests\Employers\AddEmployerRequest;
use App\Http\Requests\Employers\EditEmployerRequest;
use App\Http\Requests\Employers\AddSpeadEmployer;
class EmployersController extends Controller
{

    private $employer;

    private $support;

    public function __construct(EmployersInterface $employer, SupportInterface $support)
    {
        $this->employer = $employer;
        $this->support = $support;
    }

    //get all employer
    public function index($limit)
    {
        return $this->employer->getAll($limit);
    }

    public function getEmployersByCompany(Request $request)
    {
        return $this->employer->getEmployersByCompany($request);
    }

    //Delete employer
    public function destroy($id)
    {
        return $this->employer->del($id);
    }

    //Add employer
    public function add(AddEmployerRequest $request)
    {
        if ($request['user_image']) {
           $request['user_image'] = $this->support->UploadImg($request['user_image']);
        } else {
            $request['user_image'] = '';
        }

        return $this->employer->add($request);
    }

    //Get Employer with id
    public function get($id){
        return $this->employer->get($id);
    }

    // Edit
    public function Edit(EditEmployerRequest $request, $id){
        return $this->employer->Edit($id, $request);
    }

    //get list with comp
    public function EmpCompany($id){
        return $this->employer->EmpCompany($id);
    }

    //add Employers Spead
    public function AddSpead(AddSpeadEmployer $request){
        return $this->employer->add($request);
    }

    public function getsNgayLvNv(Request $request)
    {
        return $this->employer->getsNgayLvNv($request);
    }

    public function getsArrUser(Request $request)
    {
        return $this->employer->getsArrUser($request);
    }

    public function delCawhereID(Request $request)
    {
        return $this->employer->delCawhereID($request);
    }

    public function getListUser(Request $request)
    {
        return $this->employer->getListUser($request);
    }

    public function getCongNv(Request $request)
    {
        return $this->employer->getCongNv($request);
    }
    
    public function totalCong(Request $request)
    {
        return $this->employer->totalCong($request);
    }

    public function allEmployersDangder($limit)
    {
        return $this->employer->allEmployersDangder($limit);
    }
    
    public function openCompany($id){
        return $this->employer->openCompany($id);
    }

    public function userPerMiss(Request $request)
    {
        return $this->employer->userPerMiss($request);
    }


}
