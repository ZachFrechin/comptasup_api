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
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse {
        $fields = $request->validated();

        $user = User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $profil = Profil::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'naissance' => $fields['naissance'],
            'code_postal' => $fields['code_postal'] ?? null,
            'ville' => $fields['ville'] ?? null,
            'pays' => $fields['pays'] ?? null,
            'rue' => $fields['rue'] ?? null,
            'numero_de_rue' => $fields['numero_de_rue'] ?? null,
            'user_id' => $user->id,
        ]);

        //TODO: Ajouter le rôle Salarié par défaut.
        $user->roles()->attach(Role::first());
        $userRessource = new UserResource($user);

        return response()->json([
            "user_created" => $userRessource
        ]);
    }

    public function login(LoginRequest $request) : JsonResponse{
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Les identifiants de connexion sont incorrects'
            ], 401);
        }

        $user = Auth::user();
        $roleNames = $user->roles()->get()->pluck('nom')->toArray();
        $token = $user->createToken('auth_token', $roleNames);

        return response()->json([
            "token" => $token
        ]);
    }
}
