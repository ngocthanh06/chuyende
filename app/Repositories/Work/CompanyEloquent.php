<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\CompanyInterface;
use App\Models\Company;
use DB;
use Hash;
class CompanyEloquent implements CompanyInterface
{
     //get all list Company
    public function getAll(){
        return Company::all();    
    }
       
    
    
    
}
