<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\AttendanceInterface;
use App\Models\Attendance;
use DB;
use Hash;
use Auth;
class AttendanceEloquent implements AttendanceInterface
{
   public function getAttendanceWhereId($request){ 
      return Attendance::where([['Att_time', $request->Att_time],['Workshifts_id', $request->Workshifts_id]])->first();
   }
   public function getsWorkAttendance($request){ 
      return Attendance::with('user')
                        ->where([['Att_time', $request->Att_time],['Workshifts_id', $request->Workshifts_id]])
                        ->get();
  }
  public function updateAttendance($request){
     $attendance = Attendance::find($request['Att_id']);

     $request['Att_status'] === 0 ? $attendance['Att_status'] = 1 : $attendance['Att_status'] = $request['Att_status'];
     $attendance['Att_accept'] = $request['Att_accept'];
     $attendance['User_accept'] = $request['User_accept'];
     $attendance->save();
      return response()->json([
         'code' => 200,
         'messages'=>'Thành công'
      ]);
  }
}