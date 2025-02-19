<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DepenseResource;

class NoteResource extends JsonResource
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
            "commentaire" => $this->commentaire,
            'nom' => $this->nom,
            "etat" => $this->etat,
            "user_id" => $this->user_id,
            "depenses"=> DepenseResource::collection($this->depenses),
            "totalTTC" => $this->depenses->sum("totalTTC"),
            "controleur_id" => $this->controleur_id,
            "validateur_id" => $this->validateur_id
        ];
    }
}
