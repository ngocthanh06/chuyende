<?php

namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Models\Employer;
use DB;
use Hash;
use App\User;
use \App\Models\FormM;
use App\Models\WorkShifts;
use Carbon\Carbon;
class EmployersEloquen implements EmployersInterface
{
    public function allEmployersDangder($limit){
        try
        {
            return Employer::where('active', 0)->paginate($limit);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 500, 'message' => 'Không có dữ liệu']);
        }; 
    }
    public function openCompany($id){
        try
        {
            $del = Employer::find($id);
            $del['active'] = 1;
            $del->save();
            return response()
                ->json(['code' => 200, 'messages' => 'Thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 500, 'message' => 'Không có dữ liệu']);
        };
    }
    //get all list employers
    public function getAll($limit)
    {
        try
        {
            return Employer::where('active', 1)->paginate($limit);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 500, 'message' => 'Không có dữ liệu']);
        };
    }
    //delete
    public function del($id)
    {
        try
        {
            $del = Employer::find($id);
            $del['Date_end'] = Carbon::now()->toDateTimeString();
            $del['active'] = 0;
            $del->save();
            return response()
                ->json(['code' => 200, 'messages' => 'Thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 500, 'message' => 'Không có dữ liệu']);
        };
    }
    //Add
    public function add($request)
    {
        $request['sex'] == 'Nam' ? $request['sex'] = 1 : $request['sex'] = 2;
        $request['password'] = Hash::make($request["Password"]);
        if($request['checked'] == true){
            $request['socical_insurance'] = 1;
        }
        else 
        $request['socical_insurance'] = 0;
        Employer::create($request->all());

        // return $request;
        return response()
            ->json(['code' => '200', 'messages' => 'Thành công']);

    }
    // get
    public function get($id)
    {
        return Employer::find($id);
    }
    // Edit
    public function Edit($id, $value)
    {
        $employer = Employer::find($id);
        $value['sex'] == 'Nam' ? $employer['sex'] = 1 : $employer['sex'] = 2;
        $value['checked'] == true ? $employer['socical_insurance'] = 1 : $employer['socical_insurance'] = 2;
        if (!Hash::check($employer['password'], Hash::make($value->password))) $employer['password'] = hash::make($value->password);
        $employer['Birthday'] = $value->Birthday;
        $employer['Date_start'] = $value->Date_start;
        $employer['Role_id'] = $value->Role_id;
        $employer['User_add'] = $value->User_add;
        $employer['User_bank'] = $value->User_bank;
        $employer['User_fullname'] = $value->User_fullname;
        // $employer['User_image'] = $value->User_image;
        $employer['User_phone'] = $value->User_phone;
        $employer['idComp'] = $value->idComp;
        $employer['email'] = $value->email;

        // $employer = $value;
        $employer->update();
        return response()
            ->json(['code' => '200', 'messages' => 'Thành công']);

    }

    //Get Employer with Company with role = 1
    public function EmpCompany($id)
    {
        return Employer::where([['idComp', $id], ['Role_id', 1]])->get();
    }

    //Add Employer Spead
    public function AddSpead($request)
    {
        $user = new Employer();
        $user['sex'] == 'Nam' ? $request['sex'] = 1 : $request['sex'] = 2;
        $user['password'] = Hash::make($request["Password"]);
        $user['User_phone'] = $request->User_phone;
        $user['idComp'] = $request->idComp;
        $user['User_fullname'] = $request->User_fullname;
        $user['username'] = $request->username;
        $user['Role_id'] = $request->Role_id;
        $user->save();
        return response()
            ->json(['code' => '200', 'messages' => 'Thành công']);
    }

    public function getsNgayLvNv($request)
    {
        //form->workshift(where date)->users(where idC)
        $companyId = $request->idComp;
        $date = $request->date;

        $formMs = FormM::with(array(
            'workshifts' => function ($q) use ($date, $companyId)
            {
                $q->whereHas('user', function ($p) use ($companyId)
                {
                    $p->where('idComp', $companyId);
                });
                $q->whereIn('workshifts.WS_date', $date);
            }
        ))->get();

        // foreach($formM as $val){
        // }
        return $formMs;
    }
    //Lấy danh sách người dùng đã đăng ký ca làm trong ngày
    public function getsArrUser($request)
    {
        $day = $request['date'];
        $value = $request['val'];
        $user = [];
        foreach ($value as $val)
        {
            if ($val['WS_date'] == $day)
            {
                $formId = $val['FormM_id'];
                // $user[] = User::find($val['User_id']);
                $user[] = User::with(['workshifts' => function($q) use($day, $formId){
                    $q->where('WS_date', $day);
                    $q->where('FormM_id', $formId);
                }])->where('User_id', $val['User_id'])->first();
            }
        }
        return $user;
    }
    //    Xóa ca làm người dùng trong ngày
    public function delCawhereID($request)
    {
        $idCalam = $request['idCa'];
        $date = $request['date'];
        $value = $request['value'];

        $calam = WorkShifts::where('FormM_id', $idCalam)->Where('User_id', $value['User_id'])->Where('WS_date', $date)->first();
        $calam->delete();
        return response()
            ->json(['code' => '200', 'messages' => 'Thành công']);
    }
    //    lấy danh sách người dùng đã tồn tại ca làm việc trong ngày
    public function getListUser($request)
    {
        $day = $request['date'];
        $formId = $request['FormM_id'];
        $value = [];
        $user = DB::table('users')->join('workshifts', 'users.User_id', 'workshifts.User_id')
            ->where([['users.idComp', $request['idComp']], ['workshifts.WS_date', $request['date']], ['workshifts.FormM_id', $request['FormM_id']]])->get();
        for ($i = 0;$i < count($user);$i++)
        {
            if ($user[$i]->WS_date == $request['date'])
            {
                // $value[] = User::find($user[$i]->User_id);
                $value[] = User::with(['workshifts' => function($q) use($day, $formId){
                    $q->where('WS_date', $day);
                    $q->where('FormM_id', $formId);
                }])->where('User_id',$user[$i]->User_id)->first();
            }
        }
        return $value;

    }
    // Lấy tất cả danh sách nhân viên trong công ty
    public function getEmployersByCompany($request)
    {
        $emp = User::where('idComp', $request['idComp'])->get()
            ->toArray();
        return $emp;
    }
    /**
     * Todo get cong NV
     * @param $request: => idComp | month + year
     * * Response: arr[]
     */
    public function getCongNv($request){
        $idComp = $request->idComp;
        $date = explode(' - ', $request->date);
        $month = $date[0];
        $year = $date[1]; 
        if($idComp != 0){
            return User::with(array('workshifts' => function ($q) use ($month, $year) {
                $q->whereMonth('WS_date', $month);
                $q->whereYear('WS_date', $year);
                $q->where('status', 2);
                $q->with('formm');
            }))->where('idComp', $idComp)->get();
        }
        else {
            return User::with(array('workshifts' => function ($q) use ($month, $year) {
                $q->whereMonth('WS_date', $month);
                $q->whereYear('WS_date', $year);
                $q->with('formm');
                // $q->where('status', 2);
            }))->get();
        }
    }
    /**
     * Todo get count cong
     * @param $request: => date | month + year
     * * Response: arr[]
     */
    public function totalCong($request){
        $idComp = $request['idComp'];
        $date = explode(' - ', $request['date']);
        $month = $date[0];
        $year = $date[1]; 
        return $idComp == 0 ? $this->countCong($month, $year) : $this->countCongWhere($idComp, $month, $year);          
    }

    /**
     * Todo get count cong where idcomp != 0
     * @param $request: => date | month + year
     * * Response: arr[]
     */

    public function countCongWhere($idComp, $month, $year){
        return User::with(['workshifts' => function($q) use($idComp, $month, $year) {
            $q->whereYear('WS_date', $year);
            $q->whereMonth('WS_date', $month);
            $q->where('status', 2);
            $q->with('formm');
            }])->where('idComp', $idComp)->get();
    }
    /**
     * Todo get count cong where idcomp = 0
     * @param $request: => date | month + year
     * * Response: arr[]
     */
    public function countCong($month, $year){
        return User::with(['workshifts' => function($q) use($month, $year) {
            $q->whereYear('WS_date', $year);
            $q->whereMonth('WS_date', $month);
            $q->where('status', 2);
            $q->with('formm');
        }])->get();
    }


    /**
     * Todo get count cong
     * @param $request: => date | month + year
     * * Response: arr[]
     */
    public function userPerMiss($request) {
        $User_id = $request->id;
        $day = explode('-', $request->date);
        $month = $day[0];
        $year = $day[1]; 
        return User::with(array('role' , 'workshifts' => function ($q) use ($month, $year) {
            $q->whereMonth('WS_date', $month);
            $q->whereYear('WS_date', $year); 
            $q->where('status', 2);
            $q->with('formm');
        }))->where('User_id', $User_id)->first();
    }
}

