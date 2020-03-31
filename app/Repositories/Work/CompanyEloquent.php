<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\CompanyInterface;
use App\Models\Company;
use DB;
use Hash;
use Auth;
use App\User;
class CompanyEloquent implements CompanyInterface
{
     //get all list Company
    public function getAll(){ 
        return Company::all();    
    }
       
    public function getLimit($limit){ 
        try{ 
            // return auth()->user();
            // trường hợp lấy chi nhánh người dùng quản lý
            return Company::paginate($limit);
        }catch(Exception $e){
            return response()->json([
                'code' => 500,
                'message' => 'Không có dữ liệu'
            ]);
        };    
    }

    public function store($request){
        Company::create($request->all());
        return response()->json([
            'code' => '200',
            'messages' => 'Thành công'
        ]);
    }
    
    public function destroy($id){
        $listUser = User::where('idComp',$id)->get()->toArray();
        if(empty($listUser)){
            $company = Company::find($id);
            $company->delete();
            return 'true';
        }
        else return 'false';
    }
    
}
