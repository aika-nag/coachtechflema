<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            //
            'payment' => 'required',
            'zipcode' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'payment.required' => 'お支払い方法を選択してください',
            'zipcode.required' => '配送先住所(郵便番号)を入力してください',
            'address.required' => '配送先住所を入力してください'
        ];
    }
}
