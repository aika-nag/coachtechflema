<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            //
            'name' => 'required|max:20',
            'zipcode' => ['required', 'regex:/^[0-9]{3}\-[0-9]{4}$/'],
            'address' => 'required',
            'image' => 'mimes:jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'name.max' => 'お名前は20文字以内で入力してください',
            'zipcode.required' => '郵便番号を入力してください',
            'zipcode.regex' => '郵便番号はハイフンを入れて8文字で入力してください',
            'address.required' => '住所を入力してください',
            'image.mimes' => '画像ファイル（JPEGまたはPNG）を選択してください'
        ];
    }
}
