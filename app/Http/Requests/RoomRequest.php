<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:rooms,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui long nhập tên phòng',
            'name.unique' => 'Tên phòng đã tồn tại'
        ];
    }
}
