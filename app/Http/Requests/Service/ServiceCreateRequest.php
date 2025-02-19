<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
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
            "nom"=> "string|required",
            "description"=> "string",
            "numero"=> "string|required",
        ];
    }

    public function messages(): array
    {
        return [
            "nom.required" => "Le champ nom est requis.",
            "nom.string" => "Le champ nom doit être une chaîne de caractères.",
            "description.string" => "Le champ description doit être une chaîne de caractères.",
            "numero.required" => "Le champ numéro est requis.",
            "numero.string" => "Le champ numéro doit être une chaîne de caractères.",
        ];
    }
}
