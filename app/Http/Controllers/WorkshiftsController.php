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
}
