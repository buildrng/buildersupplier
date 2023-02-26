<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'uid' => 'required',
            'store_id' => 'required',
            'date_time' => 'required',
            'paid_method' => 'required',
            'order_to' => 'required',
            'orders' => 'required',
            'notes' => 'required',
            'total' => 'required',
            'tax' => 'required',
            'grand_total' => 'required',
            'discount' => 'required',
            'delivery_charge' => 'required',
            'extra' => 'required',
            'pay_key' => 'required',
            'status' => 'required',
            'payStatus' => 'required'
        ];
    }
}
