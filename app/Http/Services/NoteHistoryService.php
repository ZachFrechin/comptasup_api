<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Note;

class NoteHistoryService extends Service
{
    public function findByNoteID(Note $note) : Collection
    {
        return NoteHistory::where('note_id', $note->id)->get();
    }
}
