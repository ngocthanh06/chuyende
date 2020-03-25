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
      return Attendance::where([['Att_time', $request->Att_time],['Workshifts_id', $request->Workshifts_id]])
      ->get();
  }
}
