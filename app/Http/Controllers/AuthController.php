<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * This method attempts to authenticate the user using the provided credentials.
     * If authentication is successful, it generates a token with the user's permissions
     * and returns a successful authentication response. Otherwise, it returns a credentials
     * error response.
     *
     * @param LoginRequest $request The login request containing user credentials.
     * @return JsonResponse The response indicating authentication success or failure.
     */

    public function login(LoginRequest $request) : JsonResponse{

        // attempt to auth user
        if (!Auth::attempt($request->validated()))
        {
            // return credentials error response
            return response()->authCredentials();
        }
    
        // setup array of permissions for the user's token
        $user = Auth::user();
        $permissions = $user->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('nom')
            ->unique()
            ->toArray();

        // return auth success response
        return response()->authSuccess(UserResource::make($user), $user->createToken($user->id, $permissions)->plainTextToken,);
    }
}
