<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'code_postal' => $this->profil->code_postal,
            'ville' => $this->profil->ville,
            'pays' => $this->profil->pays,
            'rue' => $this->profil->rue,
            'numero_de_rue' => $this->profil->numero_de_rue,
            'ressource' => $this->profil->ressource,
            'roles' => Role::collection($this->roles)
        ];
    }
}