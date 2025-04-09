<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class VehiculeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "brand" => $this->brand,
            "model" => $this->model,
            "immatriculation" => $this->immatriculation,
            "profil_id" => $this->profil_id,
            "chevaux_fiscaux" => $this->chevaux_fiscaux,
            "fichiers" => $this->getFichiersUrls(),
        ];
    }

    private function getFichiersUrls(): array
    {
        $directory = 'public/vehicules/' . $this->id;
        $files = Storage::files($directory);
        
        return array_map(fn($file) => basename($file), $files);
    }
}
