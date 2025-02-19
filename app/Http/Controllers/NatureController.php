<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;
use App\Http\Resources\NatureResource;
use App\Http\Requests\Nature\NatureCreateRequest;


class NatureController extends Controller
{

    /**
     * Afficher la liste de toutes les natures.
     *
     * @api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->resourceCollection(NatureResource::collection(Nature::all()));
    }

    /**
     * Store a newly created nature in storage.
     *
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NatureCreateRequest $request)
    {
        $nature = Nature::create(array_merge(
            $request->validated(),
            ['user_id' => $request->user()->id]
        ));
        return response()->resourceCreated(NatureResource::make($nature));
    }

    /**
     * Afficher une nature en particulier.
     *
     * @api
     * @param  \App\Models\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function show(Nature $nature)
    {
        return response()->resource(NatureResource::make($nature));
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
