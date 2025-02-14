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
            "note" => $this->note_id,
            "nature" => NatureResource::make($this->nature),
            "totalTTC" => $this->totalTTC,
            "date" => $this->date,
            "tiers" => $this->tiers,
            'SIRET' => $this->SIRET,
            "fichiers" => $this->getFichiersUrls(),
        ];
    }
    private function getFichiersUrls(): array
    {
        $directory = 'public/depenses/' . $this->id;
        $files = Storage::files($directory);
        
        return array_map(fn($file) => basename($file), $files);
    }

}
