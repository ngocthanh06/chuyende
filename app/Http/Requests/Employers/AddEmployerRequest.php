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
            'username' => 'unique:users', 
            'email' => 'unique:users',          
        ];
    }

    public function messages(){
        return [
            'username.unique' => 'Tên tài khoản đã tồn tại',
            'email.unique' => 'Tên email đã tồn tại'
        ];
    }
    
}
