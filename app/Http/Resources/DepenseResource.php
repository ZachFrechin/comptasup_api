<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\NoteResource;
use App\Http\Resources\NatureResource;

use Storage;

class DepenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "details" => $this->details,
            "note" => NoteResource::make($this->note),
            "nature" => NatureResource::make($this->nature),
            "totalTTC" => $this->totalTTC,
            "date" => $this->date,
            "tiers" => $this->tiers,
            "fichiers" => $this->getFichiersUrls(),
        ];
    }
    private function getFichiersUrls(): array
    {
        $directory = 'public/depenses/' . $this->id;
        $files = Storage::files($directory); // Liste des fichiers dans le répertoire       
        return array_map(fn($file) => Storage::url($file), $files); // Génération des URLs
    }
}
