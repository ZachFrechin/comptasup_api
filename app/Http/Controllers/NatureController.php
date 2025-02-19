<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;
use App\Http\Resources\NatureResource;
use App\Http\Requests\Nature\NatureCreateRequest;


class NatureController extends Controller
{
    public function index()
    {
        return response()->resourceCollection(NatureResource::collection(Nature::all()));
    }

    public function store(NatureCreateRequest $request)
    {
        $nature = Nature::create(array_merge(
            $request->validated(),
            ['user_id' => $request->user()->id]
        ));
        return response()->resourceCreated(NatureResource::make($nature));
    }

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
