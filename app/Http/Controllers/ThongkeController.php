<?php
namespace App\Http\Controllers;
use App\User;
use App\Models\company;
use App\Models\Attendance;
use App\Models\prepayment;
use App\Models\permission;
use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
class ThongkeController extends Controller
{

    private $employer;

    public function __construct(EmployersInterface $employer){
        $this->employer = $employer;
    }

    public function loadthongke(Request $request){
        $date = explode(' - ', $request->time);
        $per = 0;
        $month = $date[0];
        $year = $date[1];
        $listNVTamung = prepayment::with(['user' => function ($q){
            $q->with('role');
            }])
            ->whereMonth('per_time', $month)
            ->whereYear('per_time', $year)
            ->paginate(10);
        $CountNVTamung = prepayment::with(['user' => function ($q){
            $q->with('role');
            }])
            ->whereMonth('per_time', $month)
            ->whereYear('per_time', $year)
            ->count();
        $totalNV = User::count();
        $nvDanglam = User::where('active', 0)->count();
        $nvDakhoa = User::where('active', 1)->count();
        $chinhanh = company::count();
        $sophep = Attendance::count();
        $phepDuyet = Attendance::where('Att_status', 1)->count();
        $phepChua = Attendance::where('Att_status', 0)->count();
        $pheptuchoi = Attendance::where('Att_status', 2)->count();
        $permission = permission::whereMonth('Per_time', $month)
                    ->whereYear('Per_time', $year)
                    ->get();
        foreach($permission as $p){
            $per = $per + $p->Per_total + $p->bonus;
        }
        $arr_dt = array('date' => $request->time, 'idComp' => 0);
        $listCong = $this->employer->totalCong($arr_dt);
        $data = array(
            'listCong' => $listCong,
            'permission' => $per,
            'totalNV' => $totalNV,
            'nvDanglam' => $nvDanglam,
            'nvDakhoa' => $nvDakhoa,
            'chiNhanh' => $chinhanh,
            'soPhep' => $sophep,
            'phepDuyet' => $phepDuyet,
            'phepChua' => $phepChua,
            'phepTuchoi' => $pheptuchoi,
            'listNVTamung' => $listNVTamung,
            'CountNVTamung' => $CountNVTamung
        );
        return $data;
    }
}
