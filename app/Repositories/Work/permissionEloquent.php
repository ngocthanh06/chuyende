<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\permissionInterface;
use App\Models\permission;

class permissionEloquent implements permissionInterface
{
    public function checkIssetPermission($request){
        $user_id = $request->user_id;
        $date = explode('-', $request->time);
        $month = $date[0];
        $year = $date[1];
        return permission::where('User_id', $user_id)
                          ->whereMonth('Per_time', $month)
                          ->whereYear('Per_time', $year)
                          ->get();
    }

}
