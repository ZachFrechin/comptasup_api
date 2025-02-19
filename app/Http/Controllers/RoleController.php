<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleCreateRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{


    public function index()
    {
        return response()->resourceCollection(RoleResource::collection(Role::all()));
    }

    public function store(RoleCreateRequest $request)
    {
        $role = Role::create($request->only(['nom', 'color']));
        $role->permissions()->sync($request->permissions);
        return response()->resourceCreated(RoleResource::make($role));
    }

    public function show(Role $role)
    {
        return response()->resource(RoleResource::make($role));
    }


    public function update(Request $request, Role $role)
    {
        // TODO
    }

    public function destroy(Role $role)
    {
        // TODO
    }
}
