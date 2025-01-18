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

        Response::macro('resourceUpdated', function (JsonResource $resource) {
            return Response::make(["data" => $resource], 201);
        });

        Response::macro('resourceDeleted', function () {
            return Response::make(["data" => "Resource has been deleted"], 200);
        });

        Response::macro('noteValidation', function (JsonResource $resource) {
            return Response::make(["data" => "Note has been validated and marked as not controlled",
                                            "note" => $resource ], 201);
        });

        Response::macro('noteRejection', function (JsonResource $resource) {
            return Response::make(["data" => "Note has been rejected and marked as rejected",
                                            "note" => $resource ], 201);
        });

        Response::macro('noteCanceltion', function (JsonResource $resource) {
            return Response::make(["data" => "Note has been canceled and marked as canceled",
                                            "note" => $resource ], 201);
        });

        Response::macro('notValidator', function () {
            return Response::make(["data" => "You are not the validator of this note"], 403);
        });

        Response::macro('fileNotFound', function () {
            return Response::make(["data" => "File not found"], 404);
        });
    }
}
