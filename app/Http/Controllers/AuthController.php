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
    
        // Récupérer toutes les permissions via les rôles de l'utilisateur
        $permissions = $user->roles()
            ->with('permissions') // Charger les permissions des rôles
            ->get()
            ->pluck('permissions') // Obtenir la collection des permissions pour chaque rôle
            ->flatten() // Aplatir les résultats en une seule collection
            ->pluck('nom') // Obtenir les noms des permissions
            ->unique() // Supprimer les doublons
            ->toArray();
    
        $token = $user->createToken($user->id, $permissions);
    
        $userResource = new UserResource($user);
    
        return response()->json([
            "token" => $token->plainTextToken,
            "user" => $userResource
        ]);
    }
}
