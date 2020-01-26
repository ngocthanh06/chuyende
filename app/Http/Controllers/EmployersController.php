<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Repositories\TodoInterfaceWork\SupportInterface;
use App\Http\Requests\Employers\AddEmployerRequest;
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
    public function add(AddEmployerRequest $request){
        if($request['User_image'])
        {
           $request['User_image'] = $this->support->UploadImg($request['User_image']);
        }
        else 
            $request['User_image'] = '';
        return $this->employer->add($request);
    }
}
