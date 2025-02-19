<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NatureController;

Route::prefix('nature')->middleware('auth:sanctum')->group(function () {
    Route::controller(NatureController::class)->group(function () {
        /**
         * @api {get} /nature Natures
         * @apiName GetNatures
         * @apiDescription Renvoie les ressources des natures en base.
         * @apiGroup Nature
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Ressources des natures.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": [
                        {
                            "id": 1,
                            "nom": "Autre",
                            "descriptor": "{\"file\": {\"ext\": [\"image\/png\", \"image\/jpeg\", \"application\/pdf\"], \"size\": 10, \"type\": \"file\", \"title\": \"Ticket\", \"position\": 0, \"required\": true}}",
                            "user": {}
                        },
                    ]
                }
        */
        Route::get('/','index');

        /**
         * @api {post} /nature/store Créer Nature
         * @apiName StoreNature
         * @apiDescription Sauve une nature en base.
         * @apiGroup Nature
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} nom Nom de la nature.
         * @apiBody {String} numero Numéro de la nature.
         * @apiBody {json:string} descriptor Fichier de description format Json.
         *
         * @apiSuccess {Object} data Ressource de la nature créée.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 Created
                {
                    "data": {
                        "id": 11,
                        "nom": "nom",
                        "descriptor": "{}",
                        "user": {}
                    }
                }
        */
        Route::post('/store','store');

        /**
         * @api {get} /nature/:id Nature
         * @apiName GetNature
         * @apiDescription Retourne la ressource d'une nature en base.
         * @apiGroup Nature
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de la nature.
         *
         * @apiSuccess {Object} data Ressource de la nature.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": {
                        "id": 1,
                        "nom": "Autre",
                        "descriptor": "{\"file\": {\"ext\": [\"image\/png\", \"image\/jpeg\", \"application\/pdf\"], \"size\": 10, \"type\": \"file\", \"title\": \"Ticket\", \"position\": 0, \"required\": true}}",
                        "user": {}
                    }
                }
        */
        Route::get('/{nature}','show');
    });
});

