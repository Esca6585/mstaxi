<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarifRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_tm' => 'required',
            'name_ru' => 'required',
            'minimum_price' => 'required',
            'every_minute_price' => 'required',
            'every_km_price' => 'required',
            'every_waiting_price' => 'required',
            'every_minute_price_outside' => 'required',
            'every_km_price_outside' => 'required',
            'image' => 'nullable',
        ];

    }
}
