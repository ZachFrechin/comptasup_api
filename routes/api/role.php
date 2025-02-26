<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::prefix('role')->middleware('auth:sanctum')->group(function () {
    Route::controller(RoleController::class)->group(function () {

        /**
         * @api {get} /role/ Roles
         * @apiName GetRoles
         * @apiDescription Retourne les ressources de la liste des roles.
         * @apiGroup Role
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Ressources des roles.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    [
                        {
                            "id": 1,
                            "nom": "Salarié",
                            "color": null,
                            "permissions": []
                        },
                        {
                            "id": 2,
                            "nom": "Valideur",
                            "color": null,
                            "permissions":
                            [
                                {
                                    "id": 6,
                                    "nom": "select_users"
                                }
                            ]
                        }
                    ]
                }
         */
        Route::get('/','index');

        /**
         * @api {get} /role/:id Role
         * @apiName GetRole
         * @apiDescription Retourne la ressource d'un role.
         * @apiGroup Role
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du rôle
         *
         * @apiSuccess {Object} data Ressource du role
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 2,
                        "nom": "Valideur",
                        "color": null,
                        "permissions": [
                            {
                                "id": 6,
                                "nom": "select_users"
                            }
                        ]
                    }
                }
         */
        Route::get('/{role}','show');

        /**
         * @api {post} /role/store Créer Role
         * @apiDescription Sauve un role en base.
         * @apiName CreateRole
         * @apiGroup Role
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} nom Nom du rôle
         * @apiBody {String} color Couleur du rôle
         * @apiBody {array:int} permissions Permissions du rôle ( cf. Permission )
         *
         * @apiSuccess {Object} data Ressource du role crée.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 Created
                {
                    "data":
                    {
                        "id": 6,
                        "nom": "zeuubi",
                        "color": "red",
                        "permissions": []
                    }
                }
         */
        Route::post('/store','store');

        /**
         * @api {put} /role/update/:id Update Role
         * @apiName UpdateRole
         * @apiDescription Met à jour un role en base.
         * @apiGroup Role
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du rôle.
         *
         * @apiBody {String} nom Nom du role
         * @apiBody {String} color Couleur du role
         *
         * @apiSuccess {Object} data Ressource du role.
         *
         * @apiSuccessExample {json} Succès:
                 HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 6,
                        "nom": "zeuubi",
                        "color": "red",
                        "permissions": []
                    }
                }
         */
        Route::put('/{role}','update');

        /**
         * @api {delete} /role/destroy/:id Supprimer Role
         * @apiName DeleteRole
         * @apiDescription Supprime un role en base.
         * @apiGroup Role
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique du role
         *
         * @apiSuccess {Object} data Message de retour.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "message" : "ok
                    }
                }
         */
        Route::delete('/{role}', 'destroy');
    });
});
