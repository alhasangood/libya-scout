<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationDetalesStoreRequest extends FormRequest
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
            'donation_entity_id' => ['required', 'exists:donation_entities,id'],
            'name' => ['required', 'max:255', 'string'],
            'person' => ['required', 'max:255', 'string'],
            'logo' => ['required', 'max:255'],
            'number' => ['required', 'max:255'],
        ];
    }
}
