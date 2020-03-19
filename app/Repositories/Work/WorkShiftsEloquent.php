<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\WorkShilftsInterface;
use DB;
use Image;
use App\Models\WorkShifts;
class WorkShiftsEloquent implements WorkShilftsInterface
{
     
    public function getAll($limit){
        return WorkShifts::with('FormM')->paginate($limit);
    }
 
    public function postWorkshifts($request){ 
        foreach($request['User_id'] as $u){
            $workshifts = new Workshifts();
            $workshifts['FormM_id'] = $request['FormM_id'];
            $workshifts['WS_date'] = $request['WS_date'];
            $workshifts['User_id'] = $u;
            $workshifts->save();
        }
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);

    }
    
    
    
}
