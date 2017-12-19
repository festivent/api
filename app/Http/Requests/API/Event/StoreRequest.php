<?php

namespace App\Http\Requests\API\Event;

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
            'title' => 'required|string|min:3|max:127',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'started_at' => 'required|date|future_date',
            'ended_at' => 'nullable|date|future_date',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'nullable|string|price_type|max:7',
            'capacity' => 'nullable|int|min:0',
            'age_limit' => 'nullable|int|min:0',
            'address_id' => 'required|int|exists:addresses,id',
            'organizer_id' => 'nullable|int|exists:organizers,id',
            'category_ids' => 'required|array',
            'category_ids.*' => 'required|int|exists:categories,id'
        ];
    }
}
