<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui long nhap ten',
            'email.required' => 'Vui long nhap dia chi email',
            'email.email' => 'Dia chi email khong hop le',
            'password.required' => 'Vui long nhap mat khau',
            'password.min' => 'mat khau phai it nhat 6 ky tu'
        ];
    }

}
