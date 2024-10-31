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
                "name" => [
                    "required",
                    "string",
                    "max:255",
                ],
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
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/",
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
                    "date",
                    "before:today",
                ],
                "code_postal" => [
                    "nullable",
                    "digits:5",
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
                ],
                "ressource" => [
                    "nullable",
                    "image",
                    "mimes:jpeg,png,jpg",
                    "max:2048",
                ],
            ];
        }


        public function messages(): array
    {
        return [
            "email.required" => "Le champ adresse e-mail est obligatoire.",
            "email.email" => "Le champ adresse e-mail doit être valide.",
            "email.unique" => "Cette adresse e-mail est déjà utilisée.",

            "password.required" => "Le champ mot de passe est obligatoire.",
            "password.string" => "Le champ mot de passe doit être une chaîne de caractères.",
            "password.min" => "Le champ mot de passe doit contenir au moins 6 caractères.",
            "password.confirmed" => "Le champ confirmation du mot de passe ne correspond pas.",
            "password.regex" => "Le champ mot de passe doit contenir au moins 6 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.",

            "nom.required" => "Le champ nom est obligatoire.",
            "nom.string" => "Le champ nom doit être une chaîne de caractères.",
            "nom.max" => "Le champ nom ne doit pas dépasser 255 caractères.",

            "prenom.required" => "Le champ prénom est obligatoire.",
            "prenom.string" => "Le champ prénom doit être une chaîne de caractères.",
            "prenom.max" => "Le champ prénom ne doit pas dépasser 255 caractères.",

            "naissance.required" => "Le champ date de naissance est obligatoire.",
            "naissance.date" => "Le champ date de naissance doit être une date valide.",
            "naissance.before" => "Le champ date de naissance doit être dans le passé.",

            "code_postal.digits" => "Le champ code postal doit comporter exactement 5 chiffres.",

            "ville.string" => "Le champ ville doit être une chaîne de caractères.",
            "ville.max" => "Le champ ville ne doit pas dépasser 255 caractères.",

            "pays.string" => "Le champ pays doit être une chaîne de caractères.",
            "pays.max" => "Le champ pays ne doit pas dépasser 255 caractères.",

            "rue.string" => "Le champ rue doit être une chaîne de caractères.",
            "rue.max" => "Le champ rue ne doit pas dépasser 255 caractères.",

            "numero_de_rue.integer" => "Le champ numéro de rue doit être un nombre entier.",

            "ressource.image" => "Le champ ressource doit être une image.",
            "ressource.mimes" => "Le champ ressource doit être au format JPEG, PNG ou JPG.",
            "ressource.max" => "Le champ ressource ne doit pas dépasser 2 Mo.",
        ];
    }
}
