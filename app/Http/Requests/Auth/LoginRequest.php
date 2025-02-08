<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Le champ email est requis.",
            "email.email" => "Le champ email doit contenir un email.",
            "email.exists" => "Cet email n'existe pas.",
            "password.required" => "Le champ password est requis."
        ];
    }
}
