<?php


namespace App\Repositories\TodoInterfaceWork;


interface AttendanceInterface
{
    public function getAttendanceWhereId($request);
    public function getsWorkAttendance($request);
    public function updateAttendance($request);
    public function listAttendance($request);
    public function checkPhep($request);
    public function createPhep($request);
    public function getsPhepNV($request);
}