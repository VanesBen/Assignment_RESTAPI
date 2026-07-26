<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:100',

            'seller_id' => 'required|numeric|exists:users,id',
            'buyer_id' => 'required|numeric|exists:users,id',

            // product_detail
            'items' => 'required|array|min:1',
            'items.*.product_id' => "required|numeric|exists:products,id|distinct",

            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:1',
        ];
    }
}
