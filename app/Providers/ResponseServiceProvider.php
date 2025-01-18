<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Response::macro('authSuccess', function (JsonResource $resource, string $token) {
            return Response::make([
                "user" => $resource,
                "token" => $token,
                "message" => "Authentification successful"
            ], 200);
        });

        Response::macro('authCredentials', function () {
            return Response::make(["data" => "Invalid credentials"], 401);
        });
        

        Response::macro('resourceCreated', function (JsonResource $resource) {
            return Response::make(["data" => $resource], 201);
        });

        Response::macro('resource', function (JsonResource $resource) {
            return Response::make(["data" => $resource], 200);
        });

        Response::macro('resourceCollection', function (AnonymousResourceCollection $resource) {
            return Response::make(["data" => $resource], 200);
        });

        Response::macro('fileNotFound', function () {
            return Response::make(["data" => "File not found"], 404);
        });
    }
}
