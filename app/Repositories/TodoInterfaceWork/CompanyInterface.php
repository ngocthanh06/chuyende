<?php


namespace App\Repositories\TodoInterfaceWork;


interface CompanyInterface
{
   //get all list Company
   public function getAll();

   public function getLimit($limit);

   public function store($request);
}