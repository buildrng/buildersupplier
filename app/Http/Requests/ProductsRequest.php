<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'store_id' => 'required',
            'cover' => 'required',
            'name' => 'required',
            'images' => 'required',
            'cid' => 'required',
            'original_price' => 'required',
            'sell_price' => 'required',
            'discount' => 'required',
            'kind' => 'required',
            'cate_id' => 'required',
            'sub_cate_id' => 'required',
            'in_home' => 'required',
            'is_single' => 'required',
            // 'have_gram' => 'required',
            // 'gram' => 'required',
            // 'have_kg' => 'required',
            // 'kg' => 'required',
            // 'have_pcs' => 'required',
            // 'pcs' => 'required',
            // 'have_liter' => 'required',
            // 'liter' => 'required',
            // 'have_ml' => 'required',
            // 'ml' => 'required',
            'type_of' => 'required',
            'in_offer' => 'required',
            'in_store' => 'required',
            'rating' => 'required',
            'total_rating' => 'required',
            'variations' => 'required',
            'size' => 'required'
        ];
    }
}
