<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{

    public function index()
    {
        return response()->json(["data" => RoleResource::collection(Role::all())] ,200);
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
    public function store(RoleCreateRequest $request)
    {
        $role = new Role();
        $role->nom = $request->nom;
        $role->color = $request->color;
        $role->save();
        $role->permissions()->sync($request->permissions);
        return response()->json(["data" => RoleResource::make($role)] ,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json(["data" => RoleResource::make($role)] ,200);
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
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
