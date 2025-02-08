<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserControlRoleRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Models\Profil;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Renvoie la liste de tous les utilisateurs
     *
     * @api
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->resourceCollection(UserResource::collection(User::all()));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \App\Http\Requests\User\UserCreateRequest $request The request containing user creation data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse The response containing the newly created User resource.
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->attach(Role::first());

        $user->profil()->create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'naissance' => $request->naissance,
            'telephone' => $request->telephone,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'rue' => $request->rue,
            'numero_de_rue' => $request->numero_de_rue,
            'service_id' => $request->service_id,
        ]);

        return response()->resourceCreated(UserResource::make($user));
    }

    /**
     * Display the specified user resource.
     *
     * @api
     * @param \App\Models\User $user The user instance to display.
     * @return \Illuminate\Http\JsonResponse The response containing the user resource.
     */
    public function show(User $user)
    {
        return response()->resource(UserResource::make($user));
    }

    /**
     * Update the specified user resource in storage.
     *
     * @api
     * @param \App\Http\Requests\User\UserUpdateRequest $request The request containing user update data.
     * @param \App\Models\User $user The user instance to update.
     * @return \Illuminate\Http\JsonResponse The response containing the updated User resource.
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user->fill($request->only($user->fillable));
        $user->profil->fill($request->only($user->profil->fillable))->save();

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->resourceUpdated(UserResource::make($user));
    }

    /**
     * Update the roles of a user.
     *
     * @api
     * @param \App\Http\Requests\User\UserControlRoleRequest $request The request containing roles to attach.
     * @param \App\Models\User $user The user instance to update.
     * @return \Illuminate\Http\JsonResponse The response containing the updated User resource.
     */
    public function updateRole(UserControlRoleRequest $request, User $user)
    {
        $user->roles()->attach($request->roles);
        return response()->resourceUpdated(UserResource::make($user));
    }

    /**
     * Detach the specified roles from the user.
     *
     * @api
     * @param \App\Http\Requests\User\UserControlRoleRequest $request The request containing roles to detach.
     * @param \App\Models\User $user The user instance to update.
     * @return \Illuminate\Http\JsonResponse The response containing the updated User resource.
     */
    public function deleteRole(UserControlRoleRequest $request, User $user)
    {
        $user->roles()->detach($request->roles);
        return response()->resourceUpdated(UserResource::make($user));
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @api
     * @param \App\Models\User $user The user instance to delete.
     * @return \Illuminate\Http\JsonResponse The response confirming the user deletion.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->resourceDeleted();
    }
}
