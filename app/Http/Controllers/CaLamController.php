<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use App\Models\WorkShifts;
use App\Models\FormM;

class CaLamController extends Controller
{
    private $caLam;

    public function __construct(FormMCaLamInterface $caLam)
    {
        $this->caLam = $caLam;
    }

    public function index()
    { 
        return $this->caLam->all();   
    }

    //Thêm ca làm 
    public function add(Request $request)
    {
        $request->validate(
            ['form_name' => 'unique:forms'],
            ['form_name.unique' => 'Tên ca làm đã tồn tại']
        );

        return $this->caLam->addCalam($request); 
    }

    //Lấy ca làm với id
    public function getcalam($id)
    {
        return $this->caLam->getcalam($id);
    }

    //post edit ca làm
    public function editCalam($id, Request $request)
    {
        $request->validate(
            ['form_name' => 'unique:forms,form_name,'.$id.',form_id'],
            ['form_name.unique' => 'Tên ca làm đã tồn tại']
        );

        return $this->caLam->editCalam($id, $request);
    }

    public function store(Request $request)
    {
        return $this->caLam->postWorkShift($request);
    }

    public function show($id)
    {
        return $this->caLam->getAll($id);
    }

    public function closeCalam($id)
    {
        return $this->caLam->closeCalam($id);
    }

    // lấy số ca làm của nhân viên trong ngày
    public function countCalam(Request $request)
    {
        return $this->caLam->countCalam($request);
    }

    // Sửa ca làm nhân viên
    public function editCalamUser(Request $request)
    {
        return $this->caLam->editCalamUser($request);
    }

    //Xóa ca làm
    public function delCalam(Request $request)
    {
        $Calam = WorkShifts::find($request->work_id);
        $Calam->delete();
        
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
}
