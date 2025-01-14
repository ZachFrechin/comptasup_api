<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $fillable = [
        'nom',
    ];

    public const NOT_VALIDATED = 1;

    public const REJECTED = 2;

    public const CANCELED = 3;

    public const NOT_CONTROLED = 4;

    public const VALIDATED = 5;

    public const ARCHIVED = 6;



    public function notes() {
        return $this->hasMany(Note::class);
    }
}
