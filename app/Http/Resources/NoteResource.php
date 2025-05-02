<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DepenseResource;
use App\Http\Resources\UserResource;

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
            "user" => UserResource::make($this->user),
            "depenses"=> DepenseResource::collection($this->depenses),
            "totalTTC" => $this->depenses->sum("totalTTC"),
            "controleur_id" => $this->controleur_id,
            "validateur_id" => $this->validateur_id,
            "created_at" => $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
