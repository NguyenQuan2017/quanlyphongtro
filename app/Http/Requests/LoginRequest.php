<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui long nhap dia chi email',
            'email.email' => 'Dia chi email khong hop le',
            'password.required' => 'Vui long nhap mat khau',
            'password.min' => 'mat khau phai it nhat 6 ky tu'
        ];
    }
}
