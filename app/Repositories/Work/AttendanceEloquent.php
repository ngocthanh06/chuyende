<?php
namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\AttendanceInterface;
use App\Models\Attendance;
use DB;
use Hash;
use Auth;
class AttendanceEloquent implements AttendanceInterface
{

    public function getAttendanceWhereId($request)
    {
        return Attendance::where([['att_time', $request->att_time], ['workshifts_id', $request
            ->workshifts_id]])
            ->first();
    }

    public function getsWorkAttendance($request)
    {
        return Attendance::with('user')->where([['att_time', $request->att_time], ['workshifts_id', $request
            ->workshifts_id]])
            ->get();
    }

    public function updateAttendance($request)
    {
        $attendance = Attendance::find($request['att_id']);
        $request['att_status'] === 0 ? $attendance['att_status'] = 1 : $attendance['att_status'] = $request['att_status'];
        $attendance['att_accept'] = $request['att_accept'];
        $attendance['user_accept'] = $request['user_accept'];
        $attendance->save();
        return response()
            ->json(['code' => 200, 'messages' => 'Thành công']);
    }

    /**
     * Todo Attendances
     * @param request => date
     */
    
    public function listAttendance($request)
    {
        return Attendance::with(['user','workshifts' => function ($q) {
               $q->with(['user' => function($p) {
                  $p->with('company');
                     }]);
                  }
               ])
               ->where('att_time', $request['date'])->get()
               ->toArray();
    }
    /**
     * Todo Attendances
     * @param request => att_status
     * @param request => att_accept
     */
    public function checkPhep($request)
    {
        $id = $request['id'];
        $admin = $request['user_id'];
        $attendance = Attendance::find($id);
        if ($request['status']) $attendance['att_status'] = $request['status'];
        $attendance['att_accept'] = $request['att_accept'];
        $attendance['user_accept'] = $request['user_id'];
        $attendance->update();
        return response()
            ->json(['code' => 200, 'messages' => 'Thành công']);
    }
    /**
     * Todo create Attendances
     * @param request => att_desc | workshilfts_id | Att_date |
     * * call => createPhep
     */
    public function createPhep($request)
    {
        $check = $this->issetAttendance($request);
        if ($check == 'true')
        {
            $attendance = new Attendance();
            $attendance['workshifts_id'] = $request['form']['work_id'];
            $attendance['att_desc'] = $request['form']['att_desc'];
            $attendance['att_time'] = $request['form']['ws_date'];
            $attendance['att_status'] = 0;
            $attendance->save();
            return response()
                ->json(['code' => 200, 'message' => 'Thành công']);
        }

    }

    /**
     * Todo check isset Attendances on day with 1 workshilfts
     * @param request => workshifts_id | att_time
     * * response => true | false
     */
    public function issetAttendance($request)
    {
        $work_id = $request['form']['work_id'];
        $time = $request['form']['ws_date'];
        $attendance = Attendance::where([['workshifts_id', $work_id], ['att_time', $time]])->first();
        if ($attendance == '')
        {
            return 'true';
        }
        return 'false';
    }
    /**
     * Todo check isset Attendances on day with 1 workshilfts
     * @param request => workshifts_id | att_time
     * * response => true | false
     */
    public function getsPhepNV($request){
        $user_id = $request['user_id'];
        $month = explode(' - ', $request['month'])[0];
        $year = explode(' - ', $request['month'])[1];
        return Attendance::with(['user','workshifts' => function ($q) use ($user_id) {
                            $q->with('formm');
                            $q->where('user_id', $user_id);
                        }])
                        ->whereMonth('att_time', $month)->whereYear('att_time', $year)->get()
                        ->toArray();
    }
    
    public function listchuaduyet($request){

        return Attendance::with(['user','workshifts' => function ($q) {
            $q->with(['user' => function($p) {
               $p->with('company');
                  }]);
               }
            ])
            ->where('att_status', 0)->get()
            ->toArray();
    }
}

