<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id' => ['required'],
            'full_name' => ['required'],
            'phone_number' => ['required'],
            'cmnd' => ['required','max:11','min:10'],
            'place_of_birth' => ['required'],
            'date_of_birth' => ['required','date_format:d/m/Y'],
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Vui lòng chọn phòng',
            'full_name.required' => 'Vui lòng nhập họ tên',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'cmnd.required' => 'Vui lòng nhập CMND',
            'cmnd.max' => 'CMND Không được vượt quá 11 ký tự',
            'cmnd.min' => 'CMND tối đa 10 ký tự',
            'place_of_birth.required' => 'Vui lòng nhập nơi sinh',
            'date_of_birth.required' => 'Vui lòng nhập năm sinh',
            'date_of_birth.date_format' => 'Năm sinh không hợp lệ'
        ];
    }
}
