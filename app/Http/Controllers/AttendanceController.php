<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\AttendanceInterface;
class AttendanceController extends Controller
{
    private $attendance;

    public function __construct(AttendanceInterface $attendance){
        $this->attendance = $attendance;
    }
    public function getAttendanceWhereId(Request $request){
        return $this->attendance->getAttendanceWhereId($request);
    }
    public function getsWorkAttendance(Request $request){
        return $this->attendance->getsWorkAttendance($request);
    }
    public function updateAttendance(Request $request){
        return $this->attendance->updateAttendance($request);
    }
    public function listAttendance(Request $request){
        return $this->attendance->listAttendance($request);
    }
    public function checkPhep(Request $request){
        return $this->attendance->checkPhep($request);
    }
    public function createPhep(Request $request){
        return $this->attendance->createPhep($request);
    }
    public function getsPhepNV(Request $request){
        return $this->attendance->getsPhepNV($request);
    }
    
}
