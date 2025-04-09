<?php

namespace App\Http\Requests\Vehicule;

use Illuminate\Foundation\Http\FormRequest;

class VehiculeCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required|max:255',
            'model' => 'string|required|max:255',
            'brand' => 'string|required|max:255',
            'immatriculation' => 'string|required|max:255',
            'carte_grise' => 'file|nullable|mimes:jpeg,png,pdf|max:10240',
            'profil_id' => 'nullable|exists:profils,id',
            'chevaux_fiscaux' => 'nullable|integer|min:1'
        ];
    }
} 