<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use App\Repositories\Work\baseEloquent;
use App\Enums\StatusFormsEnum;
use DB;

class FormMCalamEloquent extends baseEloquent implements FormMCaLamInterface
{
    public function getAll($limit)
    {
        return $this->formm->StatusOpen()->paginate($limit);
    }
    
    public function all()
    {
        return $this->formm->all();
    }
    
    public function getcalam($id)
    {
        return $this->formm->find($id);
    }
    
    public function editCalam($id, $request)
    {
        $calam = $this->formm->find($id)->update($request->all());

        if ($calam) {
            return response()->json([
                'code' => '200',
                'messages' => 'Chỉnh sửa thành công'
            ]);
        }
        
        return response()->json([
            'code' => '404',
            'messages' => 'Chỉnh sửa không thành công'
        ]);
    }

    //Thêm ca làm
    public function addCalam($request)
    {
        $calam = $this->formm->create($request->all());
        
        if ($calam) {
            return response()->json([
                'code' => '200',
                'messages' => 'Thành công'
            ]);
        }

        return response()->json([
            'code' => '404',
            'messages' => 'Không thành công'
        ]);
    }

    //add danh sách ca làm 
    public function postWorkShift($request) 
    {
        foreach ($request['form_id'] as $item) {
            $work = new WorkShifts();
            $work['user_id'] = $request['user_id'];
            $work['ws_date'] = $request['ws_date'];
            $work['form_id'] =  $item['form_id'];
            $work->save();    
        }

        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }

    // lây hết nhân viên trong công ty
    public function countCalam($request)
    {
        // lây hết nhân viên trong công ty
        $User = User::where('idComp', $request->id)->get();
        $Day = $request->date;
        $Calam = [];

        foreach ($Day as $d) {
            foreach ($User as $U) {
                $Calam [] = DB::table('forms')
                    ->join('workshifts','forms.form_id','workshifts.form_id')
                    ->where('workshifts.user_id', $U->user_id)
                    ->where('workshifts.ws_date', $d)
                    ->get();
            }
        }

        return $Calam;
    }
    
    // Sửa ca làm
    public function editCalamUser($request)
    {
        return WorkShifts::with('formm')
            ->where('user_id', $request->user_id)
            ->where('ws_date', $request->ws_date)
            ->get();
    }

    public function closeCalam($id)
    {
        return response()->json(
            $close = $this->formm->find($id)->update(['status' => StatusFormsEnum::CLOSE])
        );
    }
    
    
    
}
