<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;

class Vehicule extends Model
{
    protected $fillable = [
        'plaque',
        'chevaux_fiscaux',
        'ressource',
        'profil_id'
    ];

    public function profil() {
        return $this->belongsTo(Profil::class);
    }
}
