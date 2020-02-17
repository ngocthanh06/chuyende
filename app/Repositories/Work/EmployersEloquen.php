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
     
    //Get Employer with Company
    public function EmpCompany($id){
        return Employer::where('idComp',$id)->get();
    }  
    
   //Add Employer Spead
   public function AddSpead($request){
        $user = new Employer();
        $user['sex'] == 'Nam' ? $request['sex'] = 1 : $request['sex'] = 2;
        $user['Password'] = Hash::make($request["Password"]);
        $user['User_phone'] = $request->User_phone;
        $user['idComp'] = $request->idComp;
        $user['User_fullname'] = $request->User_fullname;
        $user['username'] = $request->username;
        $user['Role_id'] = $request->Role_id;
        $user->save();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
   }
    
    
}
