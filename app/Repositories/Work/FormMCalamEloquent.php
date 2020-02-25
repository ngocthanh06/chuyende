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
