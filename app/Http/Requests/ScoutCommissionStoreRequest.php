<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoutCommissionStoreRequest extends FormRequest
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
            'phone' => ['required', 'max:255'],
            'status' => ['required', 'max:255'],
            // 'store_house_id' => ['required', 'exists:store_houses,id'],
           
            // 'user_id' => ['required', 'exists:users,id'],
          
        ];
    }
}
