<?php

namespace App\Http\Requests\Depense;

use Illuminate\Foundation\Http\FormRequest;

class DepenseUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

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
