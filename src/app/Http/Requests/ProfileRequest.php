<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avatar'    => ['nullable', 'image', 'mimes:jpeg,png', 'max:3072'],

            'name'      => ['required', 'string', 'max:50'],

            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],

            'address'   => ['required', 'string', 'max:255'],

            'building' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'avatar.image'    => 'プロフィール画像は画像ファイルを選択してください。',
            'avatar.mimes'    => 'プロフィール画像はjpegまたはpng形式でアップロードしてください。',
            'avatar.max'      => 'プロフィール画像は3MB以下のファイルを選択してください。',

            'name.required'   => 'ユーザー名を入力してください。',
            'name.string'     => 'ユーザー名は文字列で入力してください。',
            'name.max'        => 'ユーザー名は50文字以内で入力してください。',

            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.regex'    => '郵便番号は「123-4567」の形式で入力してください。',

            'address.required' => '住所を入力してください。',
            'address.string'   => '住所は文字列で入力してください。',
            'address.max'      => '住所は255文字以内で入力してください。',
        ];
    }
}
