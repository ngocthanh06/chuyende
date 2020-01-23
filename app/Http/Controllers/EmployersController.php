<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
class EmployersController extends Controller
{

    private $employer;
    public function __construct(EmployersInterface $employer){
        $this->employer = $employer;
    }
    //get all employer
    public function index($limit){
        return $this->employer->getAll($limit);
    }
    //Delete employer
    public function destroy($id){
        return $this->employer->del($id);
    }
}
