<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Etat;

class EtatService extends Service
{
    public function create(string $name) : Etat
    {
        return Etat::create(['nom' => $name]);
    }
}
