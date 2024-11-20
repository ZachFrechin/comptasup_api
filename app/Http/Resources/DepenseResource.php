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
            "descriptor" => Storage::json("depense/" . $this->id),
            "note" => NoteResource::make($this->note),
            "nature" => NoteResource::make($this->nature),
            "totalTTC" => $this->totalTTC,
            "date" => $this->date,
            "tiers" => $this->tiers,
        ];
    }
}
