<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

    class RegisterRequest extends FormRequest
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
                "email" => [
                    "required",
                    "email",
                    "unique:users,email",
                ],
                "password" => [
                    "required",
                    "string",
                    "min:6",
                    "confirmed",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-])[A-Za-z\d@$!%*?&-]{6,}$/",
                ],
                "nom" => [
                    "required",
                    "string",
                    "max:255",
                ],
                "prenom" => [
                    "required",
                    "string",
                    "max:255",
                ],
                "naissance" => [
                    "required",
                    "date_format:Y-m-d",
                    "before:today",
                ],
                "code_postal" => [
                    "nullable",
                    "string",
                    "regex:/^\d{5}$/",
                ],
                "ville" => [
                    "nullable",
                    "string",
                    "max:255",
                ],
                "pays" => [
                    "nullable",
                    "string",
                    "max:255",
                ],
                "rue" => [
                    "nullable",
                    "string",
                    "max:255",
                ],
                "numero_de_rue" => [
                    "nullable",
                    "integer",
                ]
            ];
        }


        public function messages(): array
    {
        return [
            "email.required" => "Le champ email est obligatoire.",
            "email.email" => "Le champ email doit être valide (ex: example@example.com).",
            "email.unique" => "Cette adresse e-mail est déjà utilisée.",

            "password.required" => "Le champ password est obligatoire.",
            "password.string" => "Le champ password doit être une chaîne de caractères.",
            "password.min" => "Le champ password doit contenir au moins 6 caractères.",
            "password.confirmed" => "Le champ password_confirmation du mot de passe ne correspond pas.",
            "password.regex" => "Le champ password doit contenir au moins 6 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial [@$!%*?&-].",

            "nom.required" => "Le champ nom est obligatoire.",
            "nom.string" => "Le champ nom doit être une chaîne de caractères.",
            "nom.max" => "Le champ nom ne doit pas dépasser 255 caractères.",

            "prenom.required" => "Le champ prenom est obligatoire.",
            "prenom.string" => "Le champ prenom doit être une chaîne de caractères.",
            "prenom.max" => "Le champ prenom ne doit pas dépasser 255 caractères.",

            "naissance.required" => "Le champ naissance est obligatoire.",
            "naissance.date_format" => "Le champ naissance doit être une date valide (YYYY-MM-dd).",
            "naissance.before" => "Le champ naissance doit être dans le passé.",

            "code_postal.string" => "Le champ code postal doit être une chaîne de caractères.",
            "code_postal.regex" => "Le champ code postal doit contenir uniquement 5 chiffres.",

            "ville.string" => "Le champ ville doit être une chaîne de caractères.",
            "ville.max" => "Le champ ville ne doit pas dépasser 255 caractères.",

            "pays.string" => "Le champ pays doit être une chaîne de caractères.",
            "pays.max" => "Le champ pays ne doit pas dépasser 255 caractères.",

            "rue.string" => "Le champ rue doit être une chaîne de caractères.",
            "rue.max" => "Le champ rue ne doit pas dépasser 255 caractères.",

            "numero_de_rue.integer" => "Le champ numéro de rue doit être un nombre entier.",
        ];
    }
}
