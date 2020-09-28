<?php

namespace App\Http\Requests\Employers;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployerRequest extends FormRequest
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
            'username' => 'unique:users,username,'.$this->segment(3).',user_id',
            'email' => 'unique:users,email,'.$this->segment(3).',user_id',
        ];
    }
    public function messages(){
        return[
            'username.unique' => 'Tên tài khoản đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
        ];
    }
}
