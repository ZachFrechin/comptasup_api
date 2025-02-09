<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Etat;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use App\Http\Requests\Note\NoteCreateRequest;



class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexByValidator(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::where('validateur_id', $request->user()->id)
                    ->when($request->query('etat'), function ($query, int $etatId) {
                        $query->where('etat_id', $etatId);
                    })
                    ->get()
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexByControler(Request $request)
    {
        return response()->resourceCollection(
            NoteResource::collection(
                Note::select('id', 'user_id', 'validateur_id', 'controleur_id', 'etat_id')
                    ->where('controleur_id', $request->user()->id)
                    ->when($request->query('etat'), function ($query, $etatId) {
                        $query->where('etat_id', $etatId);
                    })
                    ->get()
            )
        );
    }

    /**
     * Valide une note.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function validate(Request $request, Note $note)
    {
        if ($note->validateur_id !== $request->user()->id) {
            return response()->notValidator();
        }

        $controlers = Role::find(3)->users->pluck('id')->first();
        $note->update(['controleur_id' => $controlers, 'etat_id' => Etat::NOT_CONTROLED]);

        return response()->noteValidation(NoteResource::make($note));
    }

    /**
     * Rejette une note.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Request $request, Note $note) {

        if($request->comment) {
            $note->commentaire = $request->comment;
        }

        if ($note->validateur_id !== $request->user()->id) {
            return response()->notValidator();
        }

        $note->fill([
            'comment' => $request->comment ?? $note->comment,
            'etat_id' => Etat::REJECTED,
        ])->save();

        return response()->noteRejection(NoteResource::make($note));
    }

    /**
     * Annule une note.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request, Note $note) {
        if ($note->validateur_id !== $request->user()->id) {
            return response()->notValidator();
        }

        $note->fill([
            'comment' => $request->comment ?? $note->comment,
            'etat_id' => Etat::CANCELED,
        ])->save();

        return response()->noteCanceltion(NoteResource::make($note));
    }

    /**
     * Store a newly created note in storage.
     *
     * @param \App\Http\Requests\Note\NoteCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NoteCreateRequest $request)
    {

        $validatorId = Role::find(2)->users()->pluck('users.id')->first();

        $note = Note::create(array_merge(
            $request->validated(),
            [
                'validateur_id' => $validatorId,
                'user_id' => $request->user()->id,
            ]
        ));

        return response()->resourceCreated(NoteResource::make($note));
    }

    /**
     * Affiche une note de frais.
     *
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\JsonResponse
     */
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
