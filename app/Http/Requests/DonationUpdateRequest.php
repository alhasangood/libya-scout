<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationUpdateRequest extends FormRequest
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
            'status' => ['required', 'max:255'],
            'donation_detales_id' => ['required', 'exists:donation_detales,id'],
            'order_id' => ['required', 'exists:orders,id'],
        ];
    }
}
