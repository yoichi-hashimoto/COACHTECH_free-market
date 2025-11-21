<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseRequest extends FormRequest
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
        return 
        [
        'item_id'        => ['required','integer','exists:items,id'],
        'address_id'     => ['required','integer','exists:addresses,id'],
        'payment_method' => ['required', Rule::in(['カード支払い','コンビニ払い'])],
        'subtotal'       => ['required','integer','min:1'],
        ];
    }

    public function messages(){
        return
        [
            'payment_method.required' => '支払い方法を選択してください',
            'payment_method.in' => '支払い方法を選択してください',
        ];
    }
}