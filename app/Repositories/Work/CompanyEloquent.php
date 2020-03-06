<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\CompanyInterface;
use App\Models\Company;
use DB;
use Hash;
use Auth;
class CompanyEloquent implements CompanyInterface
{
     //get all list Company
    public function getAll(){
        return Company::all();    
    }
       
    public function getLimit($limit){ 
        try{
            return auth()->user();
            return Company::paginate($limit);
        }catch(Exception $e){
            return response()->json([
                'code' => 500,
                'message' => 'Không có dữ liệu'
            ]);
        };    
    }

    public function store($request){
        
    }
    
    
}
