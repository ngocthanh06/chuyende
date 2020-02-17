<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use DB;
use Image;
use App\Models\FormM;
use App\Models\WorkShifts;
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
    
    
    
}
