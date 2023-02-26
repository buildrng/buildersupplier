<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequireRequest extends FormRequest
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
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'cover'=>'required',
            'country_code'=>'required',
            'password' => 'required',
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'cid' => 'required',
            'zipcode' => 'required'
        ];
    }
}
