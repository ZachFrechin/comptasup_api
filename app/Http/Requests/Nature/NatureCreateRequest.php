<?php

namespace App\Http\Requests\Nature;

use Illuminate\Foundation\Http\FormRequest;

class NatureCreateRequest extends FormRequest
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
             "numero" =>"string|required",
             "nom" =>"string|required",
             "descriptor" => "json|required",
        ];
    }

    public function messages(): array
    {
        return [
            "nom.required"=> "Le champ nom est requis.",
            "nom.string"=> "Le champ nom doit être une chaîne de caractères.",
            "numero.string" => "Le champ numéro doit être une chaîne de caractères.",
            "numero.required"=> "Le champ numéro est requis.",
            "descrptor.json" => "Le champ descriptor doit être une chaîne de caractères.",
            "descriptor.required" => "Le champ descriptor est requis.",
        ];
    }
}
