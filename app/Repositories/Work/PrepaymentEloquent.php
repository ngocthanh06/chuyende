<?php

namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\PrepaymentInterface;
use App\Models\prepayment;
use App\User;

class PrepaymentEloquent implements PrepaymentInterface
{
    /**
     * Todo post add prepayment
     * @param array []
     * * phase 1: check count cong > 0
     * * phase 2: check isset prepayment 
     * * phase 3: submit form
     * #response => json code
     * ! can't remove
     */
    public function store($request)
    {
        $isCheck = prepayment::where([['user_id', $request->user_id], ['per_time', $request
            ->per_time],['status', 0]])
            ->first();
        if ($isCheck)
        {
            return response()->json(['code' => '500']);
        }
        else
        {
            $per = new prepayment();
            $per['per_total'] = $request->per_total;
            $per['per_desc'] = $request->per_desc;
            $per['qtycong'] = $request->qtycong;
            $per['per_time'] = $request->per_time;
            $per['user_id'] = $request->user_id;
            $per['status'] = $request->status;
            $per->save();
            return response()
                ->json(['code' => '200', 'messages' => 'Thêm thành công']);
        }
    }

    /**
     * Todo check prepayment
     * * where status = 1
     * @param array []
     * #response => json code
     * ! can't remove
     */
    public function checkPrepay($request)
    {
        $date = explode('-', $request->time);
        $month = $date[0];
        $year = $date[1];
        return prepayment::select('qtycong')->where([['user_id', $request->user_id], ['status', 1]])
            ->whereMonth('per_time', $month)->whereYear('per_time', $year)->get();
    }

    public function loadPrepayment($request){
        $user_id =  $request->user_id;
        $date = explode('-', $request->time);
        $month = $date[0];
        $year = $date[1];
        return prepayment::with(['user' => function ($q){
                        $q->with('role');
                        }])
                        ->where('user_id', $user_id)
                        ->whereMonth('per_time', $month)
                        ->whereYear('per_time', $year)
                        ->get();
    }
    public function listAll($request){
        $date = explode('-', $request->time);
        $month = $date[0];
        $year = $date[1];
        return prepayment::with(['user' => function ($q){
            $q->with('role');
            }])
            ->whereMonth('per_time', $month)
            ->whereYear('per_time', $year)
            ->get();
    }
    public function editStatus($id){
        $prepayment = prepayment::find($id);
        $prepayment['status'] = 1;
        $prepayment->save();
        return response()
                ->json(['code' => '200', 'messages' => 'Thêm thành công']); 
    }
}

