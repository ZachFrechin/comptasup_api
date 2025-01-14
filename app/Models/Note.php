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
        'user_id'
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
}
