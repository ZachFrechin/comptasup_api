<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $fillable = [
        'nom',
    ];

    public function notes() {
        return $this->hasMany(Note::class);
    }
}
