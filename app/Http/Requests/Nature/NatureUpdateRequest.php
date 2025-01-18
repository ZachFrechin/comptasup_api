<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NatureUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
             "numero" =>"string",
             "nom" =>"string",
             "descriptor" => "json",
        ];
    }

    public function messages(): array
    {
        return [
            "nom.string"=> "Le champ nom doit être une chaîne de caractères.",
            "numero.string" => "Le champ numéro doit être une chaîne de caractères.",
            "descrptor.json" => "Le champ descriptor doit être une chaîne de caractères.",
        ];
    }
}
