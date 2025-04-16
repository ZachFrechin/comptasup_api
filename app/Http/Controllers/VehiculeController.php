<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Http\Resources\VehiculeResource;
use App\Http\Requests\Vehicule\VehiculeCreateRequest;
use App\Http\Requests\Vehicule\VehiculeUpdateRequest;

class VehiculeController extends Controller
{
    public function index(Request $request)
    {
        return response()->resourceCollection(VehiculeResource::collection($this->vehiculeService()->getAll($request->user()->profil->id)));
    }

    public function store(VehiculeCreateRequest $request)
    {
        $vehicule = $this->vehiculeService()->create($request->validated());
        $this->vehiculeService()->storeFile($vehicule, $request);

        return response()->resourceCreated(VehiculeResource::make($vehicule));
    }

    public function show(Vehicule $vehicule)
    {
        return response()->resource(VehiculeResource::make($vehicule));
    }

    public function getFile(Vehicule $vehicule, string $filename)
    {
        $path = $this->vehiculeService()->getFile($vehicule, $filename);
        if ($path === null) {
            return response()->fileNotFound();
        }
        return response()->file($path);
    }

    public function update(VehiculeUpdateRequest $request, Vehicule $vehicule)
    {
        if ($request->all() == []) {
            return response()->resourceUpdateMissingField(VehiculeResource::make($vehicule));
        }

        $this->vehiculeService()->update($vehicule, $request->validated());
        $this->vehiculeService()->storeFile($vehicule, $request);

        return response()->resourceUpdated(VehiculeResource::make($vehicule));
    }

    public function destroy(Vehicule $vehicule)
    {
        $this->vehiculeService()->delete($vehicule);

        return response()->resourceDeleted();
    }
} 