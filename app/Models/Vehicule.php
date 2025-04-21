<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;

class Vehicule extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'model',
        'immatriculation',
        'profil_id',
        'chevaux_fiscaux'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function profil() {
        return $this->belongsTo(Profil::class);
    }
}
