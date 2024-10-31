<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $fillable = [
        'km',
        'debut',
        'fin',
        'profil_id'
    ];

    public function profil() {
        return $this->belongsTo(Profil::class);
    }

}
