<?php

namespace App\Http\Requests\Employers;
use Illuminate\Foundation\Http\FormRequest;
class AddEmployerRequest extends FormRequest
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
            'Username' => 'unique:users',           
        ];
    }

    public function messages(){
        return [
            'Username.unique' => 'Tên tài khoản đã tồn tại',
        ];
    }
    
}
