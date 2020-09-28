<?php


namespace App\Repositories\TodoInterfaceWork;


interface PrepaymentInterface
{
   public function store($request);

   public function checkPrepay($request);

   public function loadPrepayment($request);

   public function editStatus($id);  
   
   public function listAll($request);
}