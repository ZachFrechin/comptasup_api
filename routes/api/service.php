<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::prefix('service')->middleware('auth:sanctum')->group(function () {
    Route::controller(ServiceController::class)->group(function () {
        /**
         * $ UP TO DATE
         * @api {get} /service Récupérer tous les services
         * @apiName GetServices
         * @apiGroup Service
         * * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object[]} data.services Liste des services.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "services": [
         *           {
         *             "id": 1,
         *             "nom": "Service 1",
         *             "numero" : "01"
         *           },
         *           {
         *             "id": 2,
         *             "nom": "Service 2",
         *             "numero" : "02"
         *           }
         *         ]
         *       }
         *     }
         */
        Route::get('/','index');

        /**
         * $ UP TO DATE
         * @api {get} /service/:id Récupérer un service spécifique
         * @apiName GetService
         * @apiGroup Service
         * * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Number} data.id ID du service.
         * @apiSuccess {String} data.nom Nom du service.
         * @apiSuccess {String} data.numero Numéro du service.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "id": 1,
         *         "nom": "Service 1",
         *         "numero": "01"
         *       }
         *     }
         */
        Route::get('/{service}','show');

        /**
         * $ UP TO DATE
         * @api {post} /service/store Créer un nouveau service
         * @apiName CreateService
         * @apiGroup Service
         * * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} nom Nom du service.
         * @apiBody {String} numero Numéro du service.
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Number} data.id ID du service créé.
         * @apiSuccess {String} data.nom Nom du service.
         * @apiSuccess {String} data.numero Numéro du service.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *       "data": {
         *         "id": 3,
         *         "nom": "Service 3",
         *         "numero": "03"
         *       }
         *     }
         */
        Route::post('/store','store');

        /**
         * $ UP TO DATE
         * @api {put} /service/:id Mettre à jour un service existant
         * @apiName UpdateService
         * @apiGroup Service
         * * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiBody {String} [nom] Nom du service.
         * @apiBody {String} [numero] Numéro du service.
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données mises à jour.
         * @apiSuccess {Number} data.id ID du service.
         * @apiSuccess {String} data.nom Nom du service.
         * @apiSuccess {String} data.numero Numéro du service.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "id": 2,
         *         "nom": "Service 2 modifié",
         *         "numero": "02"
         *       }
         *     }
         */
        Route::put('/{service}','update');

        /**
         * $ UP TO DATE
         * @api {delete} /service/:id Supprimer un service
         * @apiName DeleteService
         * @apiGroup Service
         * * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du service.
         *
         * @apiSuccess {String} data Message de confirmation.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": "ok"
         *     }
         */
        Route::delete('/{service}', 'destroy');
    });
});
