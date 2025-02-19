<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        /**
         * $ UP TO DATE
         * @api {get} /user/ Liste des utilisateurs
         * @apiName GetUserList
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         *  @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object[]} data.users Liste des utilisateurs.
         * @apiSuccess {Number} data.users.id ID de l'utilisateur.
         * @apiSuccess {String} data.users.email Email de l'utilisateur.
         * @apiSuccess {String} data.users.nom Nom de l'utilisateur.
         * @apiSuccess {String} data.users.prenom Prénom de l'utilisateur.
         * @apiSuccess {Date} data.users.naissance Date de naissance de l'utilisateur.
         * @apiSuccess {String} data.users.code_postal Code postal de l'utilisateur.
         * @apiSuccess {String} data.users.ville Ville de l'utilisateur.
         * @apiSuccess {String} data.users.pays Pays de l'utilisateur.
         * @apiSuccess {String} data.users.rue Rue de l'utilisateur.
         * @apiSuccess {String} data.users.numero_de_rue Numéro de rue de l'utilisateur.
         * @apiSuccess {Object[]} data.users.roles Rôles de l'utilisateur.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "users": [
         *           {
         *             "id": 1,
         *             "email": "exemple@mail.com",
         *             "nom": "Dupont",
         *             "prenom": "Jean",
         *             "naissance": "1990-01-01",
         *             "code_postal": "75001",
         *             "ville": "Paris",
         *             "pays": "France",
         *             "rue": "Rue de Rivoli",
         *             "numero_de_rue": "10",
         *             "roles": [
         *               {
         *                 "id": 1,
         *                 "nom": "Admin",
         *                 "permissions": [...]
         *               }
         *             ]
         *           }
         *         ]
         *       }
         *     }
         */
        Route::get('/', 'index');

        /**
         * $ UP TO DATE
         * @api {get} /user/:id Récupérer les informations d'un utilisateur
         * @apiName GetUser
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.user Informations de l'utilisateur.
         * @apiSuccess {Number} data.user.id ID de l'utilisateur.
         * @apiSuccess {String} data.user.email Email de l'utilisateur.
         * @apiSuccess {String} data.user.nom Nom de l'utilisateur.
         * @apiSuccess {String} data.user.prenom Prénom de l'utilisateur.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "user": {
         *           "id": 1,
         *           "email": "exemple@mail.com",
         *           "nom": "Dupont",
         *           "prenom": "Jean"
         *         }
         *       }
         *     }
         */
        Route::get('/{user}', 'show');

        /**
         * $ UP TO DATE
         * @api {post} /user/store Ajouter un nouvel utilisateur
         * @apiName CreateUser
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiBody {String} email Email de l'utilisateur.
         * @apiBody {String} password Mot de passe de l'utilisateur.
         * @apiBody {String} nom Nom de l'utilisateur.
         * @apiBody {String} prenom Prénom de l'utilisateur.
         * @apiBody {Date} naissance Date de naissance de l'utilisateur.
         * @apiBody {String} telephone Numéro de téléphone de l'utilisateur.
         * @apiBody {String} code_postal Code postal de l'utilisateur (optionel).
         * @apiBody {String} ville Ville de l'utilisateur (optionel).
         * @apiBody {String} pays Pays de l'utilisateur (optionel).
         * @apiBody {String} rue Rue de l'utilisateur (optionel).
         * @apiBody {String} numero_de_rue Numéro de rue de l'utilisateur (optionel).
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.user Utilisateur créé.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *       "data": {
         *         "user": {
         *           "id": 2,
         *           "email": "nouvelutilisateur@mail.com",
         *           "nom": "Martin",
         *           "prenom": "Paul"
         *         }
         *       }
         *     }
         */
        Route::post('/store', 'store');

        /**
         * $ UP TO DATE
         * @api {put} /user/update/:id Mettre à jour un utilisateur
         * @apiName UpdateUser
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         *
         * @apiBody {Number} id ID de l'utilisateur.
         * @apiBody {String} [email] Email de l'utilisateur.
         * @apiBody {String} [nom] Nom de l'utilisateur.
         * @apiBody {String} [prenom] Prénom de l'utilisateur.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.user Utilisateur mis à jour.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "user": {
         *           "id": 1,
         *           "email": "modifie@mail.com",
         *           "nom": "Dupont",
         *           "prenom": "Jean"
         *         }
         *       }
         *     }
         */
        Route::put('/{user}', 'update');

        /**
         * % TO UPDATE
         * @api {delete} /user/destroy/:id Supprimer un utilisateur
         * @apiName DeleteUser
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         *
         * @apiBody {Number} id ID de l'utilisateur.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {String} data.message Message de confirmation de suppression.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "message": "Utilisateur supprimé avec succès."
         *       }
         *     }
         */
        Route::delete('/{user}', 'destroy');

        /**
         * $ UP TO DATE
         * @api {put} /user/updateRole/:id Mettre à jour le rôle de l'utilisateur
         * @apiName UpdateUserRole
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         *
         * @apiBody {Number} id ID de l'utilisateur.
         * @apiBody {Number} role_id ID du nouveau rôle.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {Object} data.user Utilisateur avec le rôle mis à jour.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "user": {
         *           "id": 1,
         *           "roles": [
         *             {
         *               "id": 2,
         *               "nom": "Editor"
         *             }
         *           ]
         *         }
         *       }
         *     }
         */
        Route::put('/updateRole/{user}', 'updateRole');

        /**
         * $ UP TO DATE
         * @api {delete} /user/deleteRole/:id Supprimer le rôle de l'utilisateur
         * @apiName DeleteUserRole
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         *
         * @apiParam {Number} id ID de l'utilisateur.
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Objet de réponse contenant les données.
         * @apiSuccess {String} data.message Message de confirmation de suppression de rôle.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "message": "Rôle supprimé avec succès."
         *       }
         *     }
         */
        Route::delete('/deleteRole/{user}', 'deleteRole');
    });
});
