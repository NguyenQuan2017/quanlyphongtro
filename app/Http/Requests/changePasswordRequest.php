<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'old_password' => 'required',
           'new_password' => 'required',
           'confirm_new_password' => 'required_with:new_password|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui long nhap mat khau',
            'new_password.required' => 'Vui long nhap mat khau moi',
            'confirm_new_password.required_with' => 'Vui long nhap xac nhan mat khau',
            'confirm_new_password.same' => 'Mat khau moi va mat khau cu khong khop'
        ];
    }
}
