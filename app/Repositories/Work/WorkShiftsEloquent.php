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
    public function checkWorkshiftsWhere($request){
        // return count(Workshifts::where([['WS_date', $request['date']],['FormM_id', $request['FormM_id']]])->get());
        // return $request;
        return DB::table('workshifts')
                ->join('users', 'workshifts.User_id', 'users.User_id')
                ->where([['workshifts.WS_date', $request['date']],['workshifts.FormM_id', $request['FormM_id']],['users.idComp', $request['idComp']]])->count();
    }
    public function diemdanh($request){
        $workshifts = Workshifts::find($request->Work_id);
        $workshifts['WS_time_in'] = $request['WS_time_in'];
        $workshifts['WS_time_out'] = $request['WS_time_out'];
        $workshifts['status'] = $request['status'];
        $workshifts['Work_desc'] = $request['Work_desc'];
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
                        ['User_id', $request['User_id'] ], 
                        ['WS_date', $request['WS_date'] ],
                        ['FormM_id' , $request['FormM_id'] ] 
                        ])
                        ->first();
    }
    
    /**
     * Todo gets all workshilfts each employer
     * @param request => User_id | month
     * * response => workshilfts
     */
    public function getsWorkshilftsNV($request){ 
        $user_id = $request->User_id;
        $month = explode(' - ',$request->month)[0];
        $year = explode(' - ',$request->month)[1];
        return Workshifts::with('formm')->where('User_id', $user_id)
                        ->whereMonth('WS_date',$month)
                        ->whereYear('WS_date',$year)
                        ->get();
    }
    
}