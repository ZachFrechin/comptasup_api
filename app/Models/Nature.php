<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Depense;

class Nature extends Model
{
    protected $fillable = [
        'numero',
        'nom',
        'descriptor',
        'user_id'
    ];

    public function depenses() {
        return $this->hasMany(Depense::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

