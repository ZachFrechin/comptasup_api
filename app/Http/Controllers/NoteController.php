<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Etat;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use App\Http\Requests\Note\NoteCreateRequest;
use App\Models\NoteHistoryState;
use Illuminate\Http\JsonResponse;



class NoteController extends Controller
{

    public function index(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('user_id', $request->user()->id)
                    ->when($request->query('etat'), function ($query, int $etatId) {
                        $query->where('etat_id', $etatId);
                    })
                    ->get()
            )
        );
    }

    public function indexByValideur(Request $request)
    {
        $currentUserId = $request->user()->id;
        
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('etat_id', Etat::NOT_VALIDATED)
                    ->whereHas('user', function($query) use ($currentUserId) {
                        $query->whereHas('valideurs', function($q) use ($currentUserId) {
                            $q->where('valideur_id', $currentUserId);
                        });
                    })
                    ->get()
            )
        );
    }

    public function indexByControler(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('etat_id', Etat::NOT_CONTROLED)->get()
            )
        );
    }

    public function indexByGestionnaire(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('etat_id', Etat::VALIDATED)->get()
            )
        );
    }

    public function validate(Request $request, Note $note): JSONResponse
    {
        $controlerID = Role::find(3)->users->pluck('id')->first();
        $operator = $request->user();
        $note = $this->noteService()->changeControllerID($controlerID, $note, true, $operator);
        return response()->noteValidation(NoteResource::make($note));
    }

    public function reject(Request $request, Note $note) : JsonResponse
    {
        $operator = $request->user();
        $note = $this->noteService()->changeState(Etat::REJECTED, $note, $operator);
        $note = $this->noteService()->update($request->only(['commentaire']), $note);
        return response()->noteRejection(NoteResource::make($note));
    }

    public function cancel(Request $request, Note $note) : JsonResponse
    {
        $operator = $request->user();
        $note = $this->noteService()->changeState(Etat::CANCELED, $note, $operator);
        $note = $this->noteService()->update($request->only(['commentaire']), $note);
        return response()->noteCanceltion(NoteResource::make($note));
    }

    public function control(Request $request, Note $note) : JsonResponse
    {
        $operator = $request->user();
        $note = $this->noteService()->changeState(Etat::VALIDATED, $note, $operator);
        $note = $this->noteService()->update($request->only(['commentaire']), $note);
        return response()->noteControlled(NoteResource::make($note));
    }

    public function store(NoteCreateRequest $request)
    {
        $validatorId = Role::find(2)->users()->pluck('users.id')->first();
        $note = $this->noteService()->create($request->validated(), $validatorId, $request->user()->id);

        return response()->resourceCreated(NoteResource::make($note));
    }

    public function show(Note $note)
    {
        return response()->resource(NoteResource::make($note));
    }

    public function update(Request $request, string $id)
    {
        // TODO
    }

    public function destroy(string $id)
    {
        // TODO
    }

    public function exportPDF(Note $note)
    {
        return $this->exportService()->generatePDF($note);
    }

    public function exportCSV(Note $note)
    {
        return $this->exportService()->generateCSV($note);
    }
}
