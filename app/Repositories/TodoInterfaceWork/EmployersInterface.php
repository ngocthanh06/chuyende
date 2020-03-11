<?php


namespace App\Repositories\TodoInterfaceWork;


interface EmployersInterface
{
   //get all list employers
   public function getAll($limit);
   //delete employer
   public function del($id);
   //add employer
   public function add($request);
   //get employer
   public function get($id);
   //Edit employer
   public function Edit($id, $request);
   //Get Employer with Company
   public function EmpCompany($id);
   //Add Employer Spead
   public function AddSpead($request);
   
   public function getsNgayLvNv($request);
}