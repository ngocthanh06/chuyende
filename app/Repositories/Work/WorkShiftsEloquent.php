<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\WorkShilftsInterface;
use DB;
use Image;
use App\Models\WorkShifts;
class WorkShiftsEloquent implements WorkShilftsInterface
{
     
    public function getAll($limit){
        return WorkShifts::with('formm')->paginate($limit);
    }
 
    public function postWorkshifts($request){ 
        foreach($request['user_id'] as $u){
            $workshifts = new Workshifts();
            $workshifts['form_id'] = $request['form_id'];
            $workshifts['ws_date'] = $request['ws_date'];
            $workshifts['user_id'] = $u;
            $workshifts->save();
        }
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);

    }
    public function checkWorkshiftsWhere($request){
        // return count(Workshifts::where([['ws_date', $request['date']],['form_id', $request['form_id']]])->get());
        // return $request;
        return DB::table('workshifts')
                ->join('users', 'workshifts.user_id', 'users.user_id')
                ->where([['workshifts.ws_date', $request['date']],['workshifts.form_id', $request['form_id']],['users.idComp', $request['idComp']]])->count();
    }
    public function diemdanh($request){
        $workshifts = Workshifts::find($request->work_id);
        $workshifts['ws_time_in'] = $request['ws_time_in'];
        $workshifts['ws_time_out'] = $request['ws_time_out'];
        $workshifts['status'] = $request['status'];
        $workshifts['work_desc'] = $request['work_desc'];
        $workshifts->save();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
    
    public function getWorkshifts($id){
        return Workshifts::find($id);
    }

    public function workshilftsByformDateUser($request){
        return Workshifts::where([ 
                        ['user_id', $request['user_id'] ], 
                        ['ws_date', $request['ws_date'] ],
                        ['form_id' , $request['form_id'] ] 
                        ])
                        ->first();
    }
    
    /**
     * Todo gets all workshilfts each employer
     * @param request => user_id | month
     * * response => workshilfts
     */
    public function getsWorkshilftsNV($request){ 
        $user_id = $request->user_id;
        $month = explode(' - ',$request->month)[0];
        $year = explode(' - ',$request->month)[1];
        return Workshifts::with(['user','formm'])->where('user_id', $user_id)
        ->whereMonth('ws_date',$month)
        ->whereYear('ws_date',$year)
        ->get();
    }
    
}