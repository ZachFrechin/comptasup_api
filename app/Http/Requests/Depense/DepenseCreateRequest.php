<?php

namespace App\Http\Requests\Depense;

use Illuminate\Foundation\Http\FormRequest;

class DepenseCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => "string|required",
            'note_id' => "int|exists:notes,id|nullable",
            'totalTTC' => "numeric|required",
            'date' => "date|required",
            'tiers' => "string|nullable",
            'nature_id' => "int|exists:natures,id",
            "details" => "json|required"
        ];
    }
}
