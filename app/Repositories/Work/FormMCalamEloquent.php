<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use DB;
use Image;
use App\Models\FormM;
use App\Models\WorkShifts;
use App\Models\Company;
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
       return Company::find($id);
   }
   
   public function editCalam($id, $request){
       $calam = FormM::find($id);
       $calam['form_name'] = $request->form_name;
       $calam['form_work'] = $request->form_work;
       $calam['form_time_in'] = $request->form_time_in;
       $calam['form_time_out'] = $request->form_time_out;
       $calam['form_desc'] = $request->form_desc;
       $calam->update();
       return response()->json([
           'code' => '200',
           'messages' => 'Chỉnh sửa thành công'
       ]);
   }
    //Thêm ca làm
    public function addCalam($request){
        $validate = $request->validate([
            'form_name' => 'unique:formm',
        ],[
            'form_name.unique' => 'Tên ca làm đã tồn tại'
        ]);
        $calam = new FormM();
        $calam['form_name'] = $request->form_name;
        $calam['form_work'] = $request->form_work;
        $calam['form_time_in'] = $request->time_in;
        $calam['form_time_out'] = $request->time_out;
        $calam['form_desc'] = $request->form_desc;
        $calam->save();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
    //add danh sách ca làm 
    public function postWorkShift($request){
        foreach($request['form_id'] as $item){
            $work = new WorkShifts();
            $work['user_id'] = $request['user_id'];
            $work['ws_date'] = $request['ws_date'];
            $work['form_id'] =  $item['form_id'];
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
                $Calam [] = DB::table('forms')->join('workshifts','forms.form_id','workshifts.form_id')->where('workshifts.user_id', $U->user_id)->where('workshifts.ws_date', $d)->get();
            }
        }
        return $Calam;
    }
    // Sửa ca làm
    public function editCalamUser($request){
        return WorkShifts::with('formm')->where('user_id', $request->user_id)->where('ws_date', $request->ws_date)->get();
    }

   
    
    
    
}
