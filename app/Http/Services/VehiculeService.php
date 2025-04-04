<?php

namespace App\Http\Services;

use App\Models\Vehicule;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ServiceCallable;

class VehiculeService extends Service
{
    use ServiceCallable;

    public function create(array $fields): Vehicule
    {
        return Vehicule::create($fields);
    }

    public function getAll(): Collection
    {
        return Vehicule::all();
    }

    public function storeFile(Vehicule $vehicule, FormRequest $request): void
    {
        if ($request->hasFile('carte_grise')) {
            $name = $request->file('carte_grise')->getClientOriginalName();
            $request->file('carte_grise')->storeAs('public/vehicules/'.$vehicule->id, $name);
            $vehicule->update(['carte_grise' => $name]);
        }
    }

    public function getFile(Vehicule $vehicule, string $filename): string | null
    {
        $filePath = storage_path("app/private/public/vehicules/{$vehicule->id}/{$filename}");
        if (file_exists(filename: $filePath)) {
            return $filePath;
        }
        return null;
    }

    public function update(Vehicule $vehicule, array $fields): Vehicule
    {
        $vehicule->update($fields);
        return $vehicule;
    }
} 