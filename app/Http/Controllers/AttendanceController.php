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
}
