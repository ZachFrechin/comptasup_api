<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::prefix('role')->middleware('auth:sanctum')->group(function () {
    Route::controller(RoleController::class)->group(function () {

        /**
         * $ UP TO DATE
         * @api {get} /role/ Liste des rôles
         * @apiName GetRoleList
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object[]} data.roles Liste des rôles.
         * @apiSuccess {Number} data.roles.id ID du rôle.
         * @apiSuccess {String} data.roles.nom Nom du rôle.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "roles": [
         *           {
         *             "id": 1,
         *             "nom": "Admin"
         *           },
         *           {
         *             "id": 2,
         *             "nom": "User"
         *           }
         *         ]
         *       }
         *     }
         */
        Route::get('/','index');

        /**
         * $ UP TO DATE
         * @api {get} /role/:id Récupérer les informations d'un rôle
         * @apiName GetRole
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID du rôle.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.role Informations du rôle.
         * @apiSuccess {Number} data.role.id ID du rôle.
         * @apiSuccess {String} data.role.nom Nom du rôle.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "role": {
         *           "id": 1,
         *           "nom": "Admin"
         *         }
         *       }
         *     }
         */
        Route::get('/{role}','show');

        /**
         * $ UP TO DATE
         * @api {post} /role/store Ajouter un nouveau rôle
         * @apiName CreateRole
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiBody {String} nom Nom du rôle.
         * @apiBody {String} couleur Couleur du rôle.
         * @apiBody {array} arrayPermissions Permissions du rôle.
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.role Rôle créé.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *       "data": {
         *         "role": {
         *           "id": 3,
         *           "nom": "Editor"
         *         }
         *       }
         *     }
         */
        Route::post('/store','store');

        /**
         * % TO UPDATE
         * @api {put} /role/update/:id Mettre à jour un rôle
         * @apiName UpdateRole
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID du rôle.
         *
         * @apiBody {String} nom Nom du rôle. {Number} id ID du rôle.
         * @apiBody {String} nom Nom du rôle. {String} [nom] Nom du rôle.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.role Rôle mis à jour.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "role": {
         *           "id": 2,
         *           "nom": "User"
         *         }
         *       }
         *     }
         */
        Route::put('/{role}','update');

        /**
         * $ UP TO DATE
         * @api {delete} /role/destroy/:id Supprimer un rôle
         * @apiName DeleteRole
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID du rôle.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {String} data.message Message de confirmation de suppression du rôle.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "message": "Rôle supprimé avec succès."
         *       }
         *     }
         */
        Route::delete('/{role}', 'destroy');
    });
});
