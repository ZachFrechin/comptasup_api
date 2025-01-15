<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteCreateRequest;
use App\Http\Resources\NoteResource;
use App\Models\Role;
use App\Models\Etat;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $etatId = $request->query('etat');

        $query = Note::where('user_id', $userId);

        if ($etatId) {
            $query->where('etat_id', $etatId);
        }

        $notes = NoteResource::collection($query->get());

        return response()->json(['data' => $notes], 200);
    }

    public function indexByValidator(Request $request) {
        $userId = $request->user()->id;

        $etatId = $request->query('etat');

        $query = Note::where('validateur_id', $userId);

        if ($etatId) {
            $query->where('etat_id', $etatId);
        }

        $notes = NoteResource::collection($query->get());

        return response()->json(['data' => $notes], 200);
    }

    public function indexByControler(Request $request) {
        $userId = $request->user()->id;

        $etatId = $request->query('etat');

        $query = Note::where('controleur_id', $userId);

        if ($etatId) {
            $query->where('etat_id', $etatId);
        }

        $notes = NoteResource::collection($query->get());

        return response()->json(['data' => $notes], 200);
    }

    public function validate(Request $request, Note $note) {

        if ($note->validateur_id !== $request->user()->id) {
            return response()->json(["message" => "You are not the validator of this note."], 403);
        }

        $note->etat_id = Etat::NOT_CONTROLED;
        $note->save();

        return response()->json(["message" => "Note has been validated and marked as 'not controlled'.", "data" => new NoteResource($note)], 200);
    }

    public function reject(Request $request, Note $note) {

        if($request->comment) {
            $note->comment = $request->comment;
        }

        if ($note->validateur_id !== $request->user()->id) {
            return response()->json(["message" => "You are not the validator of this note."], 403);
        }

        $note->etat_id = Etat::REJECTED;
        $note->save();

        return response()->json(["message" => "Note has been validated and marked as 'not controlled'.", "data" => new NoteResource($note)], 200);
    }

    public function cancel(Request $request, Note $note) {

        if($request->comment) {
            $note->comment = $request->comment;
        }

        if ($note->validateur_id !== $request->user()->id) {
            return response()->json(["message" => "You are not the validator of this note."], 403);
        }

        $note->etat_id = Etat::CANCELED;
        $note->save();

        return response()->json(["message" => "Note has been validated and marked as 'not controlled'.", "data" => new NoteResource($note)], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteCreateRequest $request)
    {
        $validators = Role::find(2)->users;
        $note = Note::create($request->validated());
        $note->validateur_id = $validators[0]->id;
        $note->user_id = $request->user()->id;
        $note->save();


        return response()->json(["data" => new NoteResource($note)] ,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return response()->json(["data" => new NoteResource($note)],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
