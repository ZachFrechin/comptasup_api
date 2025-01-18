<?php

namespace App\Http\Requests\Depense;

use Illuminate\Foundation\Http\FormRequest;

class DepenseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust this logic based on your authorization requirements
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'totalTTC' => 'numeric|min:0',
            'date' => 'date',
            'tiers' => 'string|max:255',
            'nature_id' => 'nullable|exists:natures,id',
            'details' => 'json',
        ];
    }
}
