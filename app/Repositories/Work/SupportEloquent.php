<?php


namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\SupportInterface;
use DB;
use Image;
class SupportEloquent implements SupportInterface
{
     /**
     * Todo upload image
     * * Response: arr[]
     */
    public function UploadImg($image){
        //Đến số ký tự trong chuỗi photos từ dấu ';' trở ngược về trước
        $strpos= strpos($image, ';');
        //cắt chuỗi trong chuỗi photos từ vị trí 0 đến số lượng của $strpos
        $sub = substr($image, 0, $strpos);
        //Cắt chuỗi thành mảng ngay tại vị trí có dấu '/'
        $ex = explode('/', $sub)[1];
        //Đặt tên xử lý hình ảnh qua hàm time()
        $name = time().'.'.$ex;
        //Tạo size ảnh
        $img = Image::make($image)->resize(200,200);
        //Lưu trữ hình ảnh
        $upload_path = public_path()."/upload/";
        $img->save($upload_path.$name);
        return $name;
    }
    
    /**
     * Todo month | date
     * @param $request => MM-YYYY
     * * Response: arr[]
     */   
    public function getMonth($request){
        $date = explode('-', $request);
        return $date[0];
    }

    /**
     * Todo year | date
     * @param $request => MM-YYYY
     * * Response: arr[]
     */   
    public function getYear($request){
        $date = explode('-', $request);
        return $date[1];
    }
}
