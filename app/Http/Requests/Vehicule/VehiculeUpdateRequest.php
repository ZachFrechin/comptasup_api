<?php

namespace App\Http\Requests\Vehicule;

use Illuminate\Foundation\Http\FormRequest;

class VehiculeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'model' => 'string|max:255',
            'brand' => 'string|max:255',
            'date' => 'date',
            'carte_grise' => 'file|nullable|mimes:jpeg,png,pdf|max:10240',
            'profil_id' => 'nullable|exists:profils,id'
        ];
    }
} 