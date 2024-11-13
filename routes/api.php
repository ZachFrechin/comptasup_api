<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/**
 * $ UP TO DATE
 * @api {post} /login Login utilisateur
 * @apiName LoginUser
 * @apiGroup Auth
 * * @apiVersion 0.1.0
 *
 * @apiParam {String} email Email de l'utilisateur.
 * @apiParam {String} password Mot de passe de l'utilisateur.
 *
 * @apiSuccess {Object} data Objet de réponse contenant les données.
 * @apiSuccess {String} data.token Token d'authentification de l'utilisateur.
 *
 * @apiSuccessExample {json} Succès:
 *     HTTP/1.1 200 OK
 *     {
 *       "data": {
 *         "token": "eyJhbGciOiJIUzI1NiIsIn..."
 *       }
 *     }
 */
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user')->group(function () {
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
         * @apiParam {String} email Email de l'utilisateur.
         * @apiParam {String} password Mot de passe de l'utilisateur.
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
         * @apiParam {String} [email] Email de l'utilisateur.
         * @apiParam {String} [nom] Nom de l'utilisateur.
         * @apiParam {String} [prenom] Prénom de l'utilisateur.
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
        Route::put('/update/{user}', 'update');

        /**
         * % TO UPDATE
         * @api {delete} /user/destroy/:id Supprimer un utilisateur
         * @apiName DeleteUser
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
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
        Route::delete('/destroy/{user}', 'destroy');

        /**
         * $ UP TO DATE
         * @api {put} /user/updateRole/:id Mettre à jour le rôle de l'utilisateur
         * @apiName UpdateUserRole
         * @apiGroup User
         * * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de l'utilisateur.
         * @apiParam {Number} role_id ID du nouveau rôle.
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

Route::prefix('role')->group(function () {
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
        Route::get('/{id}','show');

        /**
         * $ UP TO DATE
         * @api {post} /role/store Ajouter un nouveau rôle
         * @apiName CreateRole
         * @apiGroup Role
         * * @apiVersion 0.1.0
         *
         * @apiParam {String} nom Nom du rôle.
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
         * @apiParam {String} [nom] Nom du rôle.
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
        Route::put('/update/{id}','update');

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
        Route::delete('/destroy/{id}', 'destroy');
    });
});
