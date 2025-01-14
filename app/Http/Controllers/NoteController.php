<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteCreateRequest;
use App\Http\Resources\NoteResource;
use App\Models\Role;
use App\Models\User;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => NoteResource::collection(Note::all())]);
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
        $note->etat_id = 0;
        $note->user_id = $request->user->id;

        $note->save();
        return response()->json(["data" => new NoteResource($note)] ,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return response()->json(NoteResource::make($note) ,200);
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
