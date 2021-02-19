<?php


namespace App\Repositories\TodoInterfaceWork;


interface FormMCaLamInterface
{
   public function getAll($id);

   public function All();

   public function postWorkShift($request);
   
   public function countCalam($request);

   public function editCalamUser($request);

   public function addCalam($request);

   public function getcalam($id);

   public function editCalam($id, $request);

   public function closeCalam($request);
}