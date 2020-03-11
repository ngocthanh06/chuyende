<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use App\Models\WorkShifts;
use App\User;
use DB;
class CaLamController extends Controller
{

    private $CaLam;
    public function __construct(FormMCaLamInterface $CaLam){
        $this->CaLam = $CaLam;
    }
    public function index()
    { 
        return $this->CaLam->all();   
    }
    //Thêm ca làm 
    public function add(Request $request){
        return $this->CaLam->addCalam($request); 
    }
    //Lấy ca làm với id
    public function getcalam($id){
        return $this->CaLam->getcalam($id);
    }

    //post edit ca làm
    public function editCalam($id, Request $request){
        return $this->CaLam->editCalam($id, $request);
    }

    public function store(Request $request)
    {
        return $this->CaLam->postWorkShift($request);
    }
    public function show($id)
    {
        return $this->CaLam->getAll($id);
    }
    // lấy số ca làm của nhân viên trong ngày
    public function countCalam(Request $request){
        return $this->CaLam->countCalam($request);
    }
    // Sửa ca làm nhân viên
    public function editCalamUser(Request $request){
        return $this->CaLam->editCalamUser($request);
    }
    //Xóa ca làm
    public function delCalam(Request $request){
        $Calam = WorkShifts::find($request->Work_id);
        $Calam->delete();
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
}
