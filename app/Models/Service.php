<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        "nom",
        "description",
        "numero",
    ] ;

    public function profils() {
        return $this->hasMany(Profil::class);
    }
}
