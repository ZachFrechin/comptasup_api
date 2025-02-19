<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
                "email",
                "unique:users,email",
            ],
            "password" => [
                "string",
                "min:6",
                "confirmed",
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-])[A-Za-z\d@$!%*?&-]{6,}$/",
            ],
            "roles" => "array",
            "roles.*" => "int|exists:roles,id",
        
            "profil" => ["array"],
            "profil.nom" => ["string", "max:255"],
            "profil.prenom" => ["string", "max:255"],
            "profil.naissance" => ["date_format:Y-m-d", "before:today"],
            "profil.telephone" => ["string"],
            "profil.code_postal" => ["nullable", "string", "regex:/^\d{5}$/"],
            "profil.ville" => ["nullable", "string", "max:255"],
            "profil.pays" => ["nullable", "string", "max:255"],
            "profil.rue" => ["nullable", "string", "max:255"],
            "profil.numero_de_rue" => ["nullable", "integer"],
            "profil.service_id" => ["nullable", "exists:services,id"],
        ];
    }

    public function messages(): array
    {
        return [
            "email.email" => "L'adresse email doit être valide.",
            "email.unique" => "Cette adresse email est déjà utilisée.",
            
            "password.string" => "Le mot de passe doit être une chaîne de caractères.",
            "password.min" => "Le mot de passe doit contenir au moins 6 caractères.",
            "password.confirmed" => "La confirmation du mot de passe ne correspond pas.",
            "password.regex" => "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial (@$!%*?&-).",
            
            "nom.string" => "Le nom doit être une chaîne de caractères.",
            "nom.max" => "Le nom ne peut pas dépasser 255 caractères.",
            
            "prenom.string" => "Le prénom doit être une chaîne de caractères.",
            "prenom.max" => "Le prénom ne peut pas dépasser 255 caractères.",
            
            "naissance.date_format" => "La date de naissance doit être au format AAAA-MM-JJ.",
            "naissance.before" => "La date de naissance doit être une date antérieure à aujourd'hui.",
            
            "code_postal.string" => "Le code postal doit être une chaîne de caractères.",
            "code_postal.regex" => "Le code postal doit être composé de 5 chiffres.",
            
            "ville.string" => "La ville doit être une chaîne de caractères.",
            "ville.max" => "La ville ne peut pas dépasser 255 caractères.",
            
            "pays.string" => "Le pays doit être une chaîne de caractères.",
            "pays.max" => "Le pays ne peut pas dépasser 255 caractères.",
            
            "rue.string" => "La rue doit être une chaîne de caractères.",
            "rue.max" => "La rue ne peut pas dépasser 255 caractères.",
            
            "numero_de_rue.integer" => "Le numéro de rue doit être un nombre entier.",
        ];
    }

}
