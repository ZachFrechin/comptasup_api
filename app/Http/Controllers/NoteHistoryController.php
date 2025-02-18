<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Resources\NoteHistoryResource;

class NoteHistoryController extends Controller
{
    public function getNoteHistory(Request $request, Note $note)
    {
        $collection = $this->noteHistoryService()->findByNoteID($note);
        return response()->noteHistories(NoteHistoryResource::collection($collection));
    }
}
