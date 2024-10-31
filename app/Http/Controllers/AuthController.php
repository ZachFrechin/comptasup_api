<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

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
            "token" => $token->plainTextToken
        ]);
    }
}
