<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingForStoreRequest extends FormRequest
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
            'pid' => 'required',
            'did' => 'required',
            'sid' => 'required',
            'rate' => 'required',
            'msg' => 'required',
            'way' => 'required',
            'total_rating' => 'required',
            'rating' => 'required'
        ];
    }
}
