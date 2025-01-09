<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nature;
use App\Http\Requests\NatureCreateRequest;
use App\Http\Resources\NatureResource;
use Storage;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => NatureResource::collection(Nature::all())] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(NatureCreateRequest $request)
    {
        $nature = Nature::create($request->only('nom', 'numero', 'descriptor'));
        return response()->json(['data'=> new NatureResource($nature) ,201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nature $nature)
    {
        return response()->json(['data'=> new NatureResource($nature) ,200]);
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
