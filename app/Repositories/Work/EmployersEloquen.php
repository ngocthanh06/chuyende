<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Models\Employer;
use DB;

class EmployersEloquen implements EmployersInterface
{
     //get all list employers
    public function getAll($limit){
        try{
            return Employer::paginate($limit);
        }catch(Exception $e){
            return response()->json([
                'code' => 500,
                'message' => 'Không có dữ liệu'
            ]);
        };        
    }
    //delete 
    public function del($id){
        try{
            $del = Employer::find($id);
            $del->delete();
            return response()->json([
                'code' => 200,
                'messages'=>'Thành công'
            ]);
        }catch(Exception $e){
            return response()->json([
                'code' => 500,
                'message' => 'Không có dữ liệu'
            ]);
        };  
    }
       
    
    
    
}
