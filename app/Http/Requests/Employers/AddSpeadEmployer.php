<?php

namespace App\Http\Requests\Employers;

use Illuminate\Foundation\Http\FormRequest;

class AddSpeadEmployer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Username' => 'unique:users,Username',
            'User_Phone' => 'unique:users,User_phone|min:9|max:10',
        ];
    }
    public function messages(){
        return [
            'Username.unique' => 'Tên đăng nhập hoặc số điện thoại đã tồn tại 1',
            'User_Phone.unique' => 'Tên đăng nhập hoặc số điện thoại đã tồn tại',
            'User_Phone.min' => 'Độ dài số điện thoại không hợp lệ',
            'User_Phone.max' => 'Độ dài số điện thoại không hợp lệ',
        ];
    }
}
