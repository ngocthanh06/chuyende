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

  /**
   * Todo Attendances
   * @param request => date
   */
  public function listAttendance($request){  
      return Attendance::with(['user','workshifts' => function ($q) {
                           $q->with('user');
                        } ])
                        ->where('Att_time', $request['date'])
                        ->get()->toArray(); 
  }
  /**
   * Todo Attendances
   * @param request => Att_status
   * @param request => Att_accept
   */
  public function checkPhep($request){ 
   $id = $request['id'];
   $admin = $request['User_id'];
   $attendance = Attendance::find($id);
   if($request['status'])
   $attendance['Att_status'] = $request['status'];
   $attendance['Att_accept'] = $request['Att_accept'];
   $attendance['User_accept'] = $request['User_id'];
   $attendance->update();
   return response()->json([
      'code' => 200,
      'messages'=>'Thành công'
   ]);
}
}