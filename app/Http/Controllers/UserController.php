<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Models\Profil;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(["data" => UserResource::collection(User::all())] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = new User();
        $profil = new Profil();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach(Role::first());

        $profil->nom = $request->nom;
        $profil->prenom = $request->prenom;
        $profil->naissance = $request->naissance;
        $profil->telephone = $request->telephone;
        $profil->code_postal = $request->code_postal;
        $profil->ville = $request->ville;
        $profil->pays = $request->pays;
        $profil->rue = $request->rue;
        $profil->numero_de_rue = $request->numero_de_rue;
        $profil->user_id = $user->id;

        $profil->save();


        
        return response()->json(["data" => new UserResource($user)] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UserUpdateRequest $request, User $user) : JsonResponse
    {
        $profil = $user->profil;
        $userField = $request->only($user->fillable);
        $profilField = $request->only($profil->fillable);

        $user->update($userField);
        $profil->update($profilField);

        if($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return response()->json(["data" => new UserResource($user)], 200);  
    }

    public function updateRole(Request $request, User $user): JsonResponse 
    {
        $request->validate([
            "roles" => "required|array",
            "roles.*" => "required|int|exists:roles,id"
        ]);
        $user->roles()->attach($request->roles);
        return response()->json(["data" => new UserResource($user)], 200);
    }

    public function deleteRole(Request $request, User $user): JsonResponse 
    {
        $request->validate([
            "roles" => "required|array",
            "roles.*" => "required|int|exists:roles,id"
        ]);
        $user->roles()->detach($request->roles);
        return response()->json(["data" => new UserResource($user)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(["data"=> "ok"],200);
    }
}
