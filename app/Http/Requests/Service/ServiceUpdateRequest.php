<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nom"=> "string",
            "numero"=> "string",
            "description"=> "string",
        ];
    }

    public function messages(): array
    {
        return [
            "nom.string" => "Le champ nom doit être une chaîne de caractères.",
            "description.string"=> "La description doit être une chaîne de caractères.",
            "numero.string"=> "Le numero doit être une chaîne de caractères.",
        ];
    }
}
