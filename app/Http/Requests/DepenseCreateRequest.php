<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepenseCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
