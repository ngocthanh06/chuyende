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

    private $employer, $support;
    public function __construct(EmployersInterface $employer, SupportInterface $support){
        $this->employer = $employer;
        $this->support = $support;
    }
    //get all employer
    public function index($limit){
        return $this->employer->getAll($limit);
    }
    //Delete employer
    public function destroy($id){
        return $this->employer->del($id);
    }
    //Add employer
    public function add(AddEmployerRequest $request){
        if($request['User_image'])
        {
           $request['User_image'] = $this->support->UploadImg($request['User_image']);
        }
        else 
            $request['User_image'] = '';
        return $this->employer->add($request);
    }
    //Get Employer with id
    public function get($id){
        return $this->employer->get($id);
    }
    // Edit
    public function Edit($id, EditEmployerRequest $request ){
        return $this->employer->Edit($id, $request);
    }
    //get list with comp
    public function EmpCompany($id){
        return $this->employer->EmpCompany($id);
    }
    //add Employers Spead
    public function AddSpead(AddSpeadEmployer $request){
        return $this->employer->add($request);
        // return $this->employer->AddSpead($request);
    }

    public function getsNgayLvNv(Request $request){
        return $this->employer->getsNgayLvNv($request);
    }
}
