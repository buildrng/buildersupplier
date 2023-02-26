<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'city_id' => 'required',
            'cover' => 'required',
            'position' => 'required',
            'link' => 'required',
            'type' => 'required',
            'message' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];
    }
}
