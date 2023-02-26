<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresRequest extends FormRequest
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
            'name' => 'required',
            'mobile' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'descriptions' => 'required',
            'cover' => 'required',
            'commission' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'cid' => 'required',
            'zipcode' => 'required',
            'status'=>'required'
        ];
    }
}
