<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;
use App\Models\Nature;

class Depense extends Model
{
    protected $fillable = [
        'nom',
        'note_id',
        'totalTTC',
        'date',
        'tiers',
        'nature_id',
    ];

    public function note() {
        return $this->belongsTo(Note::class);
    }

    public function nature() {
        return $this->belongsTo(Nature::class);
    }
}
