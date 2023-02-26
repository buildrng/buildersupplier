<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffersRequest extends FormRequest
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
            'name' => 'required',
            'off' => 'required',
            'type' => 'required',
            'upto' => 'required',
            'min' => 'required',
            'from' => 'required',
            'to' => 'required',
            'descriptions' => 'required',
            'image' => 'required',
            'manage' => 'required'
        ];
    }
}
