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
            ->getMonth($request->time);
        $year = $this
            ->support
            ->getYear($request->time);
        return permission::where('user_id', $user_id)->whereMonth('per_time', $month)->whereYear('per_time', $year)->get();
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
        $Insurance = $request->Insurance;
        return $idComp == 0 ? $this->allListLuongNV($month, $year, $limit, $Insurance) : $this->allListLuongNVWhereIdComp($idComp, $month, $year, $limit, $Insurance);
    }

    /**
     * Todo list all Luong NV
     * @param $month, $year
     * * Response: arr[]
     */
    public function allListLuongNV($month, $year, $limit, $Insurance){
        if($Insurance == 0){
                return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
            {
                $q->whereMonth('ws_date', $month);
                $q->whereYear('ws_date', $year);
                $q->with('formm');
            }
            , 'prepayment' => function ($p) use ($month, $year)
            {
                $p->whereMonth('per_time', $month);
                $p->whereYear('per_time', $year);
            }, 'permission' => function ($k) use ($month, $year)
            {
                $k->whereMonth('per_time', $month);
                $k->whereYear('per_time', $year);
            }
            ])->where([['role_id', 1]])->paginate($limit);    
        }
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('ws_date', $month);
            $q->whereYear('ws_date', $year);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('per_time', $month);
            $k->whereYear('per_time', $year);
        }
        ])->where([['role_id', 1],['socical_insurance', $Insurance]])->paginate($limit);
    }

    /**
     * Todo list all Luong NV
     * @param $idComp , $month, $year
     * * Response: arr[]
     */
    public function allListLuongNVWhereIdComp($idComp, $month, $year, $limit, $Insurance){
        if($Insurance == 0 ){
                return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
            {
                $q->whereMonth('ws_date', $month);
                $q->whereYear('ws_date', $year);
                $q->with('formm');
            }
            , 'prepayment' => function ($p) use ($month, $year)
            {
                $p->whereMonth('per_time', $month);
                $p->whereYear('per_time', $year);
            }, 'permission' => function ($k) use ($month, $year)
            {
                $k->whereMonth('per_time', $month);
                $k->whereYear('per_time', $year);
            }
            ])->where([['idComp', $idComp],['role_id', 1]])->paginate($limit);
        }
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('ws_date', $month);
            $q->whereYear('ws_date', $year);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('per_time', $month);
            $k->whereYear('per_time', $year);
        }
        ])->where([['idComp', $idComp],['role_id', 1],['socical_insurance', $Insurance]])->paginate($limit);
    }

    /**
     * Todo add Luong NV
     * @param $per_time , $user_id, $per_total, $bonus, $day_pay, $error
     */
    public function addLuong($request){

        $isCheck = permission::where([['user_id', $request['user_id']], ['per_time', $request['per_time']]])
                            ->first();
        if(!empty($isCheck)){
            $per = permission::find($isCheck['per_id']);
            $per['per_total'] = $request['per_total'];
            $per['day_pay'] = $request['day_pay'];
            $per['bonus'] = $request['bonus'];
            $per['error'] = $request['error'];
            $per['qty'] = $request['qty'];
            $per->save();
        }
        else
        {
            $per = new permission();
            $per['per_time'] = $request['per_time'];
            $per['user_id'] = $request['user_id'];
            $per['per_total'] = $request['per_total'];
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
            $q->whereMonth('ws_date', $month);
            $q->whereYear('ws_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('per_time', $month);
            $k->whereYear('per_time', $year);
        }
        ])->where('role_id', 1)->get();
    }

    /**
     * Todo list all Luong NV
     * @param $idComp , $month, $year
     * * Response: arr[]
     */
    public function thongkeNVWhereIdComp($idComp, $month, $year){
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('ws_date', $month);
            $q->whereYear('ws_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('per_time', $month);
            $k->whereYear('per_time', $year);
        }
        ])->where('idComp', $idComp)->get();
    }

    /**
     * Todo get luong Nhan vien
     * @param $month, $year
     */
    public function luongNV($request){
        $user_id = $request->user_id;
        $month = $this->support->getMonth($request->time);
        $year = $this->support->getYear($request->time);
        return User::with(['role', 'workshifts' => function ($q) use ($month, $year)
        {
            $q->whereMonth('ws_date', $month);
            $q->whereYear('ws_date', $year);
            $q->where('status', 2);
            $q->with('formm');
        }
        , 'prepayment' => function ($p) use ($month, $year)
        {
            $p->whereMonth('per_time', $month);
            $p->whereYear('per_time', $year);
        }, 'permission' => function ($k) use ($month, $year)
        {
            $k->whereMonth('per_time', $month);
            $k->whereYear('per_time', $year);
        }
        ])->where([['user_id', $user_id],['role_id', 1]])->get();
    }

   

}

