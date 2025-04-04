<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;

class Vehicule extends Model
{
    protected $fillable = [
        'name',
        'model',
        'brand',
        'date',
        'carte_grise',
        'profil_id'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function profil() {
        return $this->belongsTo(Profil::class);
    }
}
