<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required | max:255',
            'company_name' => 'required',
            'price' => 'required | digits_between:1,11',
            'stock' => 'required | digits_between:1,11',
            'comment' => 'max:10000',
            'photo' => 'image | max:5120',
        ];
    }

    public function attributes() 
    {
        return [
            'product_name' => '商品名',
            'company_name' => 'メーカー',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'photo' => '商品画像',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'company_name.required' => ':attributeを選択してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.digits_between' => ':attributeは:min〜:max桁の数値で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.digits_between' => ':attributeは:min〜:max桁の数値で入力してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
            'photo.image' => ':attributeには画像ファイルを指定してください。',
            'photo.max' => ':attributeは5メガバイト以下で選択してください。',
        ];
    }
}
