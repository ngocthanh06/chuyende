<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\permissionInterface;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(permissionInterface $permission)
    {
        return $this->permission = $permission;
    }

    public function checkIssetPermission(Request $request)
    {
        return $this->permission->checkIssetPermission($request);
    }

    public function listLuongNV(Request $request, $id)
    {
        return $this->permission->listLuongNV($request, $id);
    }
    public function addLuong(Request $request)
    {
        return $this->permission->addLuong($request);
    }

    public function thongke(Request $request)
    {
        return $this->permission->thongke($request);
    }

    public function luongNV(Request $request)
    {
        return $this->permission->luongNV($request);
    }
}
