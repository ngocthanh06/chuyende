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
        return Attendance::where([['Att_time', $request->Att_time], ['Workshifts_id', $request
            ->Workshifts_id]])
            ->first();
    }

    public function getsWorkAttendance($request)
    {
        return Attendance::with('user')->where([['Att_time', $request->Att_time], ['Workshifts_id', $request
            ->Workshifts_id]])
            ->get();
    }

    public function updateAttendance($request)
    {
        $attendance = Attendance::find($request['Att_id']);
        $request['Att_status'] === 0 ? $attendance['Att_status'] = 1 : $attendance['Att_status'] = $request['Att_status'];
        $attendance['Att_accept'] = $request['Att_accept'];
        $attendance['User_accept'] = $request['User_accept'];
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
               ->where('Att_time', $request['date'])->get()
               ->toArray();
    }
    /**
     * Todo Attendances
     * @param request => Att_status
     * @param request => Att_accept
     */
    public function checkPhep($request)
    {
        $id = $request['id'];
        $admin = $request['User_id'];
        $attendance = Attendance::find($id);
        if ($request['status']) $attendance['Att_status'] = $request['status'];
        $attendance['Att_accept'] = $request['Att_accept'];
        $attendance['User_accept'] = $request['User_id'];
        $attendance->update();
        return response()
            ->json(['code' => 200, 'messages' => 'Thành công']);
    }
    /**
     * Todo create Attendances
     * @param request => Att_desc | workshilfts_id | Att_date |
     * * call => createPhep
     */
    public function createPhep($request)
    {
        $check = $this->issetAttendance($request);
        if ($check == 'true')
        {
            $attendance = new Attendance();
            $attendance['Workshifts_id'] = $request['form']['Work_id'];
            $attendance['Att_desc'] = $request['form']['Att_desc'];
            $attendance['Att_time'] = $request['form']['WS_date'];
            $attendance['Att_status'] = 0;
            $attendance->save();
            return response()
                ->json(['code' => 200, 'message' => 'Thành công']);
        }

    }

    /**
     * Todo check isset Attendances on day with 1 workshilfts
     * @param request => Workshifts_id | Att_time
     * * response => true | false
     */
    public function issetAttendance($request)
    {
        $work_id = $request['form']['Work_id'];
        $time = $request['form']['WS_date'];
        $attendance = Attendance::where([['Workshifts_id', $work_id], ['Att_time', $time]])->first();
        if ($attendance == '')
        {
            return 'true';
        }
        return 'false';
    }
    /**
     * Todo check isset Attendances on day with 1 workshilfts
     * @param request => Workshifts_id | Att_time
     * * response => true | false
     */
    public function getsPhepNV($request){
        $user_id = $request['User_id'];
        $month = explode(' - ', $request['month'])[0];
        $year = explode(' - ', $request['month'])[1];
        return Attendance::with(['user','workshifts' => function ($q) use ($user_id) {
                            $q->with('FormM');
                            $q->where('User_id', $user_id);
                        }])
                        ->whereMonth('Att_time', $month)->whereYear('Att_time', $year)->get()
                        ->toArray();
    }
    
    public function listchuaduyet($request){

        return Attendance::with(['user','workshifts' => function ($q) {
            $q->with(['user' => function($p) {
               $p->with('company');
                  }]);
               }
            ])
            ->where('Att_status', 0)->get()
            ->toArray();
    }
}

