<?php


namespace App\Repositories\TodoInterfaceWork;


interface WorkShilftsInterface
{
   public function getAll($limit);

   public function postWorkshifts($request);

   public function checkWorkshiftsWhere($request);

   public function diemdanh($request);

   public function getWorkshifts($id);

   public function workshilftsByformDateUser($request);
   
   public function getsWorkshilftsNV($request);
}