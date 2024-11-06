<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

use App\Models\Profil;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $role = $request->input('role');
        $name = $request->input('name');

        $users = User::query()
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($role, function ($query, $role) {
                $query->whereHas('roles', function ($query) use ($role) {
                    $query->where('roles.name', $role);
                });
            })
            ->get();
        return response()->json(["data" => UserResource::collection($users)] ,200);
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
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $profil = new Profil();

        $profil->nom = $request->nom;
        $profil->prenom = $request->prenom;
        $profil->naissance = $request->naissance;
        $profil->code_postal = $request->code_postal;
        $profil->ville = $request->ville;
        $profil->pays = $request->pays;
        $profil->rue = $request->rue;
        $profil->numero_de_rue = $request->numero_de_rue;
        $profil->user_id = $user->id;
        $profil->save();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach(Role::first());
        
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
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $profil = $user->profil;

        if ($request->has('nom')) {
            $profil->nom = $request->nom;
        }
        if ($request->has('prenom')) {
            $profil->prenom = $request->prenom;
        }
        if ($request->has('naissance')) {
            $profil->naissance = $request->naissance;
        }
        if ($request->has('code_postal')) {
            $profil->code_postal = $request->code_postal;
        }
        if ($request->has('ville')) {
            $profil->ville = $request->ville;
        }
        if ($request->has('pays')) {
            $profil->pays = $request->pays;
        }
        if ($request->has('rue')) {
            $profil->rue = $request->rue;
        }
        if ($request->has('numero_de_rue')) {
            $profil->numero_de_rue = $request->numero_de_rue;
        }
        $profil->save();

        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json(["data" => new UserResource($user)], 200);
    }

    public function updateRoles(Request $request, string $id) {
        $request->validate([
            "roles" => "required|array",
            "roles.*" => "required|int|exists:roles,id"
        ]);
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return response()->json(["data" => new UserResource($user)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
