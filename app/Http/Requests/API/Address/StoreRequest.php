<?php

namespace App\Http\Requests\API\Address;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:127',
            'address' => 'required|string',
            'hint' => 'nullable|string',
            'province_id' => 'required|int|exists:provinces,id',
            'county_id' => 'required|int|exists:counties,id'
        ];
    }
}
