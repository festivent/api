<?php

namespace App\Http\Requests\API\User\Organizer;

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
            'telephone' => 'nullable|telephone|max:31',
            'email' => 'nullable|email|min:3|max:127'
        ];
    }
}
