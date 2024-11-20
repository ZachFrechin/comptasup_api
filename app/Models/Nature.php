<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Depense;

class Nature extends Model
{
    protected $fillable = [
        'numero',
        'nom',
    ];

    public function depenses() {
        return $this->hasMany(Depense::class);
    }
}

