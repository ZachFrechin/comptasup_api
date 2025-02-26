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

    public function indexByValidator(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('etat_id', Etat::NOT_VALIDATED)->get()
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

    public function validate(Request $request, Note $note): JSONResponse
    {
        $controlerID = Role::find(3)->users->pluck('id')->first();
        $note = $this->noteService()->changeControllerID($controlerID, $note, true);
        return response()->noteValidation(NoteResource::make($note));
    }

    public function reject(Request $request, Note $note) : JsonResponse
    {
        $note = $this->noteService()->changeState(Etat::REJECTED, $note);
        $note = $this->noteService()->update($request->only(['commentaire']), $note);
        return response()->noteRejection(NoteResource::make($note));
    }

    public function cancel(Request $request, Note $note) : JsonResponse
    {
        $note = $this->noteService()->changeState(Etat::CANCELED, $note);
        $note = $this->noteService()->update($request->only(['commentaire']), $note);
        return response()->noteCanceltion(NoteResource::make($note));
    }

    public function control(Request $request, Note $note) : JsonResponse
    {
        $note = $this->noteService()->changeState(Etat::VALIDATED, $note);
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
}
