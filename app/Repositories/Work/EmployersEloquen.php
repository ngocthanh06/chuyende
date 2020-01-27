<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Models\Employer;
use DB;
use Hash;
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
    //Add
    public function add($request){
        $request['sex'] == 'Nam' ? $request['sex'] = 1 : $request['sex'] = 2;
        $request['Password'] = Hash::make($request["Password"]);
            Employer::create($request->all());
        // return $request;
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);

    }
    // get
    public function get($id){
       return Employer::find($id);
    }
    // Edit
    public function Edit($id, $value){
        $employer = Employer::find($id);
        $employer = $value;
        return $employer;
        
    }
       
    
    
    
}
