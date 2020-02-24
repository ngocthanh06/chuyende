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
    public function index(Request $request)
    {
        return $this->CaLam->all();   
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->CaLam->postWorkShift($request);
    }
    public function show($id)
    {
        return $this->CaLam->getAll($id);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function countCalam(Request $request){
        // lây hết nhân viên trong công ty
        $User = User::where('idComp', $request->id)->get();
        $Day = $request->date;
        $Calam = [];

        foreach($Day as $d){
            foreach($User as $U){
                $Calam [] = DB::table('formm')->join('workshifts','formm.FormM_id','workshifts.FormM_id')->where('workshifts.User_id', $U->User_id)->where('workshifts.WS_date', $d)->get();
            }
        }

        return $Calam;

    }
}
