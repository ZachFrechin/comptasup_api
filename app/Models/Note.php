<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Depense;
use App\Models\Etat;

class Note extends Model
{
    protected $fillable = [
        'commentaire',
        'etat_id',
        'user_id',
        'validateur_id'
    ];

    public function depenses() {
        return $this->hasMany(Depense::class);
    }

    public function etat() {
        return $this->belongsTo(Etat::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function validateur() {
        return $this->belongsTo(User::class, 'validateur_id');
    }

    public function controleur() {
        return $this->belongsTo(User::class, 'controleur_id');
    }

}
