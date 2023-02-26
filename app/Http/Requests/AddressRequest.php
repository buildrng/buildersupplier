<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'title' => 'required',
            'address' => 'required',
            'house' => 'required',
            'landmark' => 'required',
            'pincode' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ];
    }
}
