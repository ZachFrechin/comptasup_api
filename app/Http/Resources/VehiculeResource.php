<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'nom' => $this->nom,
            'plaque' => $this->plaque,
            'chevaux_fiscaux' => $this->chevaux_fiscaux,
            'ressource' => $this->ressource,
            'date_ajout' => $this->created_at,
            'derniere_modification' => $this->updated_at
        ];
    }
}
