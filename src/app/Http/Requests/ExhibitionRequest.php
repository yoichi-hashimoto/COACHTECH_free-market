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
    public function rules():array
    {
        return [
            'avatar' =>['required','image','mimes:jpg,jpeg,png','max:3072'],
            'category' => ['required','array','min:1'],
            'category.*' => ['integer','exists:categories,id'],
            'condition' => ['required','in:良好,目立った傷や汚れ無し,やや汚れや傷あり,状態が悪い'],
            'name' => ['required','string','max:255'],
            'brand' => ['nullable','string', 'max:255'],
            'description' => ['required','string','max:1000'],
            'price' => ['required','integer','min:1'],
        ];
    }

    public function messages(){
        return[
        'avatar.required' => '画像をアップロードしてください',
        'avatar.image' => 'jpegもしくはpngファイルを選択してください',
        'avatar.max' => '3MB以内のデータを添付して下さい',
        'name.required' => '名前を入力して下さい',
        'category.required' => 'カテゴリーを選択してください',
        'condition.in' => '商品の状態を選択してください',
        'price.required' => '金額を入力してください',
        ];
    }
}
