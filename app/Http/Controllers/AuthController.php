<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request) : JsonResponse{
        if (!Auth::attempt($request->validated()))
        {
            return response()->authCredentials();
        }
        $user = Auth::user();
        $permissions = $user->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('nom')
            ->unique()
            ->toArray();

        return response()->authSuccess(UserResource::make($user), $user->createToken($user->id, $permissions)->plainTextToken);
    }
}
