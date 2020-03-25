<?php


namespace App\Repositories\TodoInterfaceWork;


interface AttendanceInterface
{
    public function getAttendanceWhereId($request);
    public function getsWorkAttendance($request);
}