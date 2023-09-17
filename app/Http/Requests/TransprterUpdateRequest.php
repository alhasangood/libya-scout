<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransprterUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'identity' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'transprter_type_id' => ['required', 'exists:transprter_types,id'],
            'photo' => ['image', 'max:1024', 'nullable'],
        ];
    }
}
