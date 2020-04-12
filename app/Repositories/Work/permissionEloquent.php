<?php

namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\permissionInterface;
use App\Repositories\TodoInterfaceWork\SupportInterface;
use App\Models\permission;
use App\User;

class permissionEloquent implements permissionInterface
{
    protected $support;

    public function __construct(SupportInterface $support)
    {
        $this->support = $support;
    }
    /**
     * Todo check isser permission
     * @param $request => month
     * * Response: arr[]
     */
    public function checkIssetPermission($request)
    {
        $user_id = $request->user_id;
        $month = $this
            ->support
            ->getMonth($request->time);;
        $year = $this
            ->support
            ->getYear($request->time);;
        return permission::where('User_id', $user_id)->whereMonth('Per_time', $month)->whereYear('Per_time', $year)->get();
    }
    /**
     * Todo list Luong NV
     * @param $request: => month | idComp(can't idComp) 
     * * Response: arr[]
     */
    public function listLuongNV($request, $limit)
    {
        $idComp = $request->idComp;
        $month = $this->support->getMonth($request->time);
        $year = $this->support->getYear($request->time);
        return $idComp == 0 ? $this->allListLuongNV($month, $year, $limit) : $this->allListLuongNVWhereIdComp($idComp, $month, $year, $limit);
    }

    /**
     * Todo list all Luong NV
     * @param $month, $year
     * * Response: arr[]
     */
    public function allListLuongNV($month, $year, $limit){
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('Per_time', $month);
            $k->whereYear('Per_time', $year);
        }
        ])->where('Role_id', 1)->paginate($limit);
    }

    /**
     * Todo list all Luong NV
     * @param $idComp , $month, $year
     * * Response: arr[]
     */
    public function allListLuongNVWhereIdComp($idComp, $month, $year, $limit){
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('Per_time', $month);
            $k->whereYear('Per_time', $year);
        }
        ])->where([['idComp', $idComp],['Role_id', 1]])->paginate($limit);
    }

    /**
     * Todo add Luong NV
     * @param $Per_time , $User_id, $Per_total, $bonus, $day_pay, $error
     */
    public function addLuong($request){

        $isCheck = permission::where([['User_id', $request['User_id']], ['Per_time', $request['Per_time']]])
                            ->first();
        if(!empty($isCheck)){
            $per = permission::find($isCheck['Per_id']);
            $per['Per_total'] = $request['Per_total'];
            $per['day_pay'] = $request['day_pay'];
            $per['bonus'] = $request['bonus'];
            $per['error'] = $request['error'];
            $per['qty'] = $request['qty'];
            $per->save();
        }
        else
        {
            $per = new permission();
            $per['Per_time'] = $request['Per_time'];
            $per['User_id'] = $request['User_id'];
            $per['Per_total'] = $request['Per_total'];
            $per['bonus'] = $request['bonus'];
            $per['day_pay'] = $request['day_pay'];
            $per['error'] = $request['error'];
            $per['qty'] = $request['qty'];
            $per->save();
        }
        return response()->json([
            'code' => 200,
            'messages' => 'Thành công'
        ]);

    }

    /**
     * Todo thong ke luong
     * @param $idComp , $month, $year
     */
    public function thongke($request){
        $idComp = $request->idComp;
        $month = $this->support->getMonth($request->time);
        $year = $this->support->getYear($request->time);
        return $idComp == 0 ? $this->thongkeLuongNV($month, $year) : $this->thongkeNVWhereIdComp($idComp, $month, $year);
    }

    /**
     * Todo list all Luong NV
     * @param $month, $year
     * * Response: arr[]
     */
    public function thongkeLuongNV($month, $year){
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('Per_time', $month);
            $k->whereYear('Per_time', $year);
        }
        ])->where('Role_id', 1)->get();
    }

    /**
     * Todo list all Luong NV
     * @param $idComp , $month, $year
     * * Response: arr[]
     */
    public function thongkeNVWhereIdComp($idComp, $month, $year){
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('Per_time', $month);
            $k->whereYear('Per_time', $year);
        }
        ])->where('idComp', $idComp)->get();
    }

    /**
     * Todo get luong Nhan vien
     * @param $month, $year
     */
    public function luongNV($request){
        $User_id = $request->User_id;
        $month = $this->support->getMonth($request->time);
        $year = $this->support->getYear($request->time);
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('Per_time', $month);
            $k->whereYear('Per_time', $year);
        }
        ])->where([['User_id', $User_id],['Role_id', 1]])->get();
    }

   

}

