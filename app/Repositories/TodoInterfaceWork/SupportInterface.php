<?php


namespace App\Repositories\TodoInterfaceWork;


interface SupportInterface
{
   public function UploadImg($img);
   
   public function getMonth($request);

   public function getYear($request);
}