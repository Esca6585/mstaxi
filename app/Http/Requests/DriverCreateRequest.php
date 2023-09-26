<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverCreateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'car_number' => 'required',
            'car_model' => 'required',
            'birthday' => 'required',
            'start_working' => 'required',
            'status' => 'required|boolean',
        ];
    }
}
