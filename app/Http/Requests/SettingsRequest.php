<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'currencySymbol' => 'required',
            'currencySide' => 'required',
            'currencyCode' => 'required',
            'appDirection' => 'required',
            'logo' => 'required',
            'sms_name' => 'required',
            'sms_creds' => 'required',
            'country_modal' => 'required',
            'web_category' => 'required',
            'default_country_code' => 'required',
            'default_city_id' => 'required',
            'default_delivery_zip' => 'required',
            'app_color' => 'required',
            'fcm_token' => 'required'
        ];
    }
}
