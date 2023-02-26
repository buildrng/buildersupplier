<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriversRequiredRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return tru;
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
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'cid' => 'required',
        ];
    }
}
