<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Models\Note;
use App\Http\Services\Service;
use App\Models\Etat;
use Illuminate\Http\JsonResponse;


class NoteService extends Service
{
    public function create(array $fields, int $valideurID, int $authorID) : Note
    {
        return Note::create(array_merge(
            $fields,
            [
                'validateur_id' => $valideurID,
                'user_id' => $authorID,
                'etat_id' => Etat::NOT_VALIDATED
            ]
        ));
    }
    public function update(array $fields, Note $note) : Note
    {
        $note->update($fields);
        return $note;
    }
    public function addHistory(int $base, int $final, Note $note): NoteHistory
    {
        return NoteHistory::create([
            'etat_base_id' => $base,
            'etat_final_id' => $final,
            'note_id' => $note->id,
            'user_id' => $note->user_id
        ]);
    }
    
    public function changeState(int $type, Note $note): Note
    {
        $note->update(['etat_id' => $type]);
        $this->addHistory($note->etat_id, $type, $note);
        return $note;
    }

    public function changeControllerID(int $controllerID, Note $note, bool $changeState = false): Note
    {
        $note->update(['controleur_id' => $controllerID]);
        if ($changeState) {
            $this->changeState(Etat::NOT_CONTROLED, $note);
        }
        return $note;
    }

    // ! function will return the return of callback function ( probably a correct response )
    public function checkValideurID(int $id, Note $note, array $payload, callable $callback): JsonResponse
    {
        if ($note->validateur_id === $id)
        {
            return $callback($note, $payload);
        } else
        {
            return response()->notValidator();
        }
    }
}
