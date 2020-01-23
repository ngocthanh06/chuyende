<?php


namespace App\Repositories\TodoInterfaceWork;


interface EmployersInterface
{
   //get all list employers
   public function getAll($limit);
   //delete employer
   public function del($id);
   
}