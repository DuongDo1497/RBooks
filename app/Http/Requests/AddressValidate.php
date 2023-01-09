<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressValidate extends FormRequest
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
            'fullname' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ tên',
            'phone.required'  => 'Vui lòng nhập số điện thoại',
            'city.required' => 'Vui lòng nhập Tỉnh/Tp',
            'district.required' => 'Vui lòng nhập Quận/Huyện',
            'address.required' => 'Vui lòng nhập Địa chỉ',
        ];
    }
}
