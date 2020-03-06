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
            return Employer::where('active',1)->paginate($limit);
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
            $del['active'] = 0;
            $del->save();
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
        $request['password'] = Hash::make($request["Password"]);
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
        $value['sex'] == 'Nam' ? $employer['sex'] = 1 : $employer['sex'] = 2;
        if(!Hash::check($employer['password'],Hash::make($value->password)))
            $employer['password'] =  hash::make($value->password);
            $employer['Birthday'] = $value->Birthday; 
            $employer['Date_start'] = $value->Date_start;
            $employer['Role_id'] = $value->Role_id;
            $employer['User_add'] = $value->User_add;
            $employer['User_bank'] = $value->User_bank;
            $employer['User_fullname'] = $value->User_fullname;
            // $employer['User_image'] = $value->User_image;
            $employer['User_phone'] = $value->User_phone;
            $employer['idComp'] = $value->idComp;  
            $employer['email'] = $value->email;

        // $employer = $value;
        $employer->update();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]); 
        
    }
     
    //Get Employer with Company
    public function EmpCompany($id){
        return Employer::where('idComp',$id)->get();
    }  
    
   //Add Employer Spead
   public function AddSpead($request){
        $user = new Employer();
        $user['sex'] == 'Nam' ? $request['sex'] = 1 : $request['sex'] = 2;
        $user['password'] = Hash::make($request["Password"]);
        $user['User_phone'] = $request->User_phone;
        $user['idComp'] = $request->idComp;
        $user['User_fullname'] = $request->User_fullname;
        $user['username'] = $request->Username;
        $user['Role_id'] = $request->Role_id;
        $user->save();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
   }
    
    
}
