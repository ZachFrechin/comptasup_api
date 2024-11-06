<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Profil;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use App\Http\Resources\UserResource;


class AuthController extends Controller
{
    public function login(LoginRequest $request) : JsonResponse{
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Les identifiants de connexion sont incorrects'
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $permissions = $user->roles()->permissions()->pluck('name')->toArray();
        $token = $user->createToken($user->id, $permissions);

        $userRessource = new UserResource($user);

        return response()->json([
            "token" => $token->plainTextToken,
            "user" => $userRessource
        ]);
    }
}
