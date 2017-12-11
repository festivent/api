<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
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
            'email' => 'required|email|max:127',
            'password' => 'required|string|password|min:8|max:32|confirmed',
            'password_confirmation' => 'required|string|password|min:8|max:32',
            'gender' => 'required|string|max:7|gender',
            'birth_at' => 'required|date'
        ];
    }
}
