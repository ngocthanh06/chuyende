<?php


namespace App\Repositories\TodoInterfaceWork;


interface WorkShilftsInterface
{
   public function getAll($limit);
   public function postWorkshifts($request);
}