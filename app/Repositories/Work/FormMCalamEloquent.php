<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use DB;
use Image;
use App\Models\FormM;
use App\Models\WorkShifts;
use App\User;
class FormMCalamEloquent implements FormMCaLamInterface
{
     
    public function getAll($limit){
        return FormM::paginate($limit);
    }
    
    public function all(){
        return FormM::all();
    }
    //Lấy ca làm với id 
    
   public function getcalam($id){
       return FormM::find($id);
   }
   
   public function editCalam($id, $request){
       $calam = FormM::find($id);
       $calam['FormM_name'] = $request->FormM_name;
       $calam['FormM_Work'] = $request->FormM_Work;
       $calam['FormM_TimeIn'] = $request->FormM_TimeIn;
       $calam['FormM_TimeOut'] = $request->FormM_TimeOut;
       $calam['FormM_desc'] = $request->FormM_desc;
       $calam->update();
       return response()->json([
           'code' => '200',
           'messages' => 'Chỉnh sửa thành công'
       ]);
   }
    //Thêm ca làm
    public function addCalam($request){
        $validate = $request->validate([
            'FormM_name' => 'unique:formm',
        ],[
            'FormM_name.unique' => 'Tên ca làm đã tồn tại'
        ]);
        $calam = new FormM();
        $calam['FormM_name'] = $request->FormM_name;
        $calam['FormM_Work'] = $request->FormM_Work;
        $calam['FormM_TimeIn'] = $request->time_in;
        $calam['FormM_TimeOut'] = $request->time_out;
        $calam['FormM_desc'] = $request->FormM_desc;
        $calam->save();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
    //add danh sách ca làm 
    public function postWorkShift($request){
        foreach($request['FormM_id'] as $item){
            $work = new WorkShifts();
            $work['User_id'] = $request['User_id'];
            $work['WS_date'] = $request['WS_date'];
            $work['FormM_id'] =  $item['FormM_id'];
            $work->save();    
        }
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);

    }
    // lây hết nhân viên trong công ty
    public function countCalam($request){
        // lây hết nhân viên trong công ty
        $User = User::where('idComp', $request->id)->get();
        $Day = $request->date;
        $Calam = [];
        foreach($Day as $d){
            foreach($User as $U){
                $Calam [] = DB::table('formm')->join('workshifts','formm.FormM_id','workshifts.FormM_id')->where('workshifts.User_id', $U->User_id)->where('workshifts.WS_date', $d)->get();
            }
        }
        return $Calam;
    }
    // Sửa ca làm
    public function editCalamUser($request){
        return WorkShifts::with('FormM')->where('User_id', $request->User_id)->where('WS_date', $request->WS_date)->get();
    }

   
    
    
    
}
