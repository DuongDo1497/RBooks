<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftOrderValidate extends FormRequest
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
            'sendername' => 'required',
            'recipientname' => 'required',
            'address_to' => 'required',
            'phone_to' => 'required',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sendername.required' => 'Vui lòng nhập tên người gửi',
            'recipientname.required'  => 'Vui lòng nhập tên người nhận',
            'address_to.required' => 'Vui lòng nhập địa chỉ',
            'phone_to.required' => 'Vui lòng nhập sđt',
            'message.required' => 'Vui lòng để lại lời nhắn',
        ];
    }
}
