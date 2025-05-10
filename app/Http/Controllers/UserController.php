<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdatePasswordRequest;
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
    public function index(Request $request): JsonResponse
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('nom', $request->role);
            });
        }

        $users = $query->get();
        return response()->resourceCollection(UserResource::collection($users));
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService()->create(
            $request->email,
            $request->password,
            $request->profil
        );

        $user = $this->userService()->addRolesByID($user, $request->roles);
        return response()->resourceCreated(UserResource::make($user));
    }

    public function show(User $user)
    {
        return response()->resource(UserResource::make($user));
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {

        $request->email ? $this->userService()->updateMail($user, $request->email) : null;
        $request->password ? $this->userService()->updatePassword($user, $request->password) : null;
        $request->profil ? $this->userService()->updateProfil($user, $request->profil) : null;

        return response()->resourceUpdated(UserResource::make($user));
    }

    public function updatePassword(UserUpdatePasswordRequest $request): JsonResponse
    {
        $this->userService()->updatePassword($request->user(), $request->old_password, $request->password);
        return response()->resourceUpdated(UserResource::make($request->user()));
    }

    public function updateRole(UserControlRoleRequest $request, User $user)
    {
        $user->roles()->attach($request->roles);
        return response()->resourceUpdated(UserResource::make($user));
    }

    public function deleteRole(UserControlRoleRequest $request, User $user)
    {
        $user->roles()->detach($request->roles);
        return response()->resourceUpdated(UserResource::make($user));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->resourceDeleted();
    }

    public function addValideur(User $user, User $valideur)
    {
        if($valideur->roles->contains('nom', 'Valideur')){
            $this->userService()->addAffiliatedUsers($valideur, [$user]);
            return response()->resourceUpdated(UserResource::make($user));
        }
        return response()->resourceUpdated(UserResource::make($user));
    }

    public function removeValideur(User $user, User $valideur)
    {
        if($valideur->roles->contains('nom', 'Valideur')){
            $this->userService()->removeAffiliatedUser($valideur, [$user]);
            return response()->resourceUpdated(UserResource::make($valideur));
        }
        return response()->resourceUpdated(UserResource::make($valideur));
    }
}
