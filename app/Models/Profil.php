<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\Trajet;
use App\Models\Service;

class Profil extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'naissance',
        'telephone',
        'code_postal',
        'ville',
        'pays',
        'rue',
        'numero_de_rue',
        'ressource',
        'user_id',
        'service_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vehicules() {
        return $this->hasMany(Vehicule::class);
    }

    public function trajets() {
        return $this->hasMany(Trajet::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
