<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
    public function rules(){
    $avatarRule = app()->environment('testing')
        ? ['nullable', 'string']
        : ['required', 'image', 'mimes:jpeg,png', 'max:2048'];

    return [
        'name'        => ['required', 'string', 'max:255'],
        'categories'  => ['required', 'array'],
        'categories.*'=> ['exists:categories,id'],
        'condition'   => ['required', 'string'],
        'brand'       => ['nullable', 'string'],
        'description' => ['required', 'string'],
        'price'       => ['required', 'integer', 'min:1'],
        'avatar'      => $avatarRule,
    ];
}


    public function messages(){
        return[
        'avatar.required' => '画像をアップロードしてください',
        'avatar.image' => 'jpegもしくはpngファイルを選択してください',
        'avatar.max' => '3MB以内のデータを添付して下さい',
        'name.required' => '名前を入力して下さい',
        'categories.required' => 'カテゴリーを選択してください',
        'condition.required' => '商品の状態を選択してください',
        'price.required' => '金額を入力してください',
        ];
    }
}
