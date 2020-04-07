<?php


namespace App\Repositories\TodoInterfaceWork;


interface permissionInterface
{
   public function checkIssetPermission($request);
   public function listLuongNV($request, $limit);
   public function addLuong($request);
   public function thongke($request);
   public function luongNV($request);
}