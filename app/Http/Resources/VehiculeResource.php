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
            "model" => $this->model,
            "brand" => $this->brand,
            "date" => $this->date,
            "carte_grise" => $this->carte_grise,
            "profil_id" => $this->profil_id,
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
