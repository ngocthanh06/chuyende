<?php


namespace App\Repositories\TodoInterfaceWork;


interface PrepaymentInterface
{
   public function store($request);
   public function checkPrepay($request);
   
}