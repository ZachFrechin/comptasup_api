<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::prefix('service')->middleware('auth:sanctum')->group(function () {
    Route::controller(ServiceController::class)->group(function () {
        /**
         * @api {get} /service Services
         * @apiName GetServices
         * @apiDescription Retourne la liste des ressources des services.
         * @apiGroup Service
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Liste des resources des services.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    [
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "numero": "1"
                        },
                        {
                            "id": 2,
                            "nom": "Management",
                            "numero": "2"
                        }
                    ]
                }
         */
        Route::get('/','index');

        /**
         * @api {get} /service/:id Service
         * @apiName GetService
         * @apiDescription Retourne la ressource du service.
         * @apiGroup Service
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiSuccess {Object} data Ressource du service.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "nom": "Comptabilité",
                        "numero": "1"
                    }
                }
         */
        Route::get('/{service}','show');

        /**
         * @api {post} /service/store Créer Service
         * @apiName CreateService
         * @apiDescription Sauve un service en base.
         * @apiGroup Service
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} nom Nom du service
         * @apiBody {String} numero Numéro du service
         * @apiBody {String} description Description du service
         *
         * @apiSuccess {Object} data Ressource du service crée.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 Created
                {
                    "data":
                    {
                        "id": 3,
                        "nom": "zeuubi",
                        "numero": "58"
                    }
                }
         */
        Route::post('/store','store');

        /**
         * @api {put} /service/:id Mettre à joue Service
         * @apiName UpdateService
         * @apiDescription Met à jour un service en base.
         * @apiGroup Service
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiBody {String} nom Nom du service.
         * @apiBody {String} numero Numéro du service.
         * @apiBody {String} description Description du service
         *
         * @apiSuccess {Object} data Ressource du service.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 3,
                        "nom": "zeuubi",
                        "numero": "588"
                    }
                }
         */
        Route::put('/{service}','update');

        /**
         * @api {delete} /service/:id Supprimer Service
         * @apiName DeleteService
         * @apiDescription Supprime un service en base.
         * @apiGroup Service
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiSuccess {Object} data Message de confirmation.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "message": "ok"
                    }
                }
         */
        Route::delete('/{service}', 'destroy');
    });
});
