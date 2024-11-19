<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'nom' => $this->profil->nom,
            'prenom' => $this->profil->prenom,
            'naissance' => $this->profil->naissance,
            'telephone' => $this->profil->telephone,
            'code_postal' => $this->profil->code_postal,
            'ville' => $this->profil->ville,
            'pays' => $this->profil->pays,
            'rue' => $this->profil->rue,
            'numero_de_rue' => $this->profil->numero_de_rue,
            'ressource' => $this->profil->ressource,
            'roles' => RoleResource::collection($this->roles),
            'vehicules' => VehiculeResource::collection($this->profil->vehicules),
            'trajets' => TrajetResource::collection($this->profil->trajets),
            'date_ajout' => $this->created_at,
            'derniere_modification' => $this->updated_at,
            "statut" => $this->active,
            "service" => $this->profil->service,
        ];
    }
}
