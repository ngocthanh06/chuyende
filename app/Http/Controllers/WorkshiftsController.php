<?php

namespace App\Http\Controllers;
use App\Repositories\TodoInterfaceWork\WorkShilftsInterface;
use Illuminate\Http\Request;

class WorkshiftsController extends Controller
{
    private $workshilfts ;
    public function __construct(WorkShilftsInterface $workshilfts){
        $this->workshilfts = $workshilfts;
    }
    //
    public function postWorkshifts(Request $request){
        return $this->workshilfts->postWorkshifts($request); 
    }

    public function checkWorkshiftsWhere(Request $request){
        return $this->workshilfts->checkWorkshiftsWhere($request);
    }

    public function diemdanh(Request $request){
        return $this->workshilfts->diemdanh($request); 
    }

    public function getWorkshifts($id){
        return $this->workshilfts->getWorkshifts($id);
    }

    
}
