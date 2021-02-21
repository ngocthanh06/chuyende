<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\CompanyInterface;
use App\Repositories\Work\baseEloquent;

class CompanyEloquent extends baseEloquent implements CompanyInterface
{
    //get all list Company
    public function getAll()
    {
        return $this->company->all();    
    }
       
    public function getLimit($limit)
    { 
        try { 
            return $this->company->paginate($limit);
        
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Không có dữ liệu'
            ]);
        };    
    }

    public function store($request)
    {
        $check = $this->company->create($request->all());

        if ($check) {
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
    
    public function destroy($id)
    {
        $listUser = $this->user->where('idComp', $id)->get()->toArray();

        if (empty($listUser)) {
            $this->company->find($id)->delete();

            return response()->json(true);
        }
        
        return response()->json(false);
    }

    public function update($request)
    {
        $check = $this->company->find($request['id'])->update($request);

        if ($check) {
            return response()->json([
                'code' => 200
            ]); 
        }

        return response()->json([
            'code' => 404
        ]);
    }

    public function getChiNhanh($id) 
    {
        return $this->company->find($id);
    }
    
}
