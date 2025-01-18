<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{

    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\JsonResponse The response containing a collection of Role resources.
     */
    public function index()
    {
        return response()->resourceCollection(RoleResource::collection(Role::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse The response containing the newly created Role resource.
     */
    public function store(RoleCreateRequest $request)
    {
        $role = Role::create($request->only(['nom', 'color']));
        $role->permissions()->sync($request->permissions);
        return response()->resourceCreated(RoleResource::make($role));
    }

    /**
     * Display the specified role resource.
     *
     * @param \App\Models\Role $role The role instance to display.
     * @return \Illuminate\Http\JsonResponse The response containing the role resource.
     */
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
