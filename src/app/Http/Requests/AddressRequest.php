<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string',
            'postal_code' => 'required|integer',
            'address' => 'required|string',
            'building' => 'string'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '名前を入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'address.reruired' => '住所を入力してください',
        ];
    }
}
