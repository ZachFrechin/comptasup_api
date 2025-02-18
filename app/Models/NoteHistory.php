<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NoteHistory extends Model
{
    protected $fillable = [
        'note_id',
        'user_id',
        'etat_base_id',
        'etat_final_id'
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baseEtat()
    {
        return $this->belongsTo(Etat::class, 'etat_base_id');
    }

    public function finalEtat()
    {
        return $this->belongsTo(Etat::class, 'etat_final_id');
    }
}
