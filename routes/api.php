<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\NoteController;

/**
 * $ UP TO DATE
 * @api {post} /login Login utilisateur
 * @apiName LoginUser
 * @apiGroup Auth
 * * @apiVersion 0.1.0
 *
 * @apiBody {String} email Email de l'utilisateur.
 * @apiBody {String} password Mot de passe de l'utilisateur.
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
        Route::get('/{id}','show');

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
        Route::put('/{id}','update');

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
        Route::delete('/{id}', 'destroy');
    });
});

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

Route::prefix('nature')->middleware('auth:sanctum')->group(function () {
    Route::controller(NatureController::class)->group(function () {
        /**
         * @api {get} /nature Liste des natures
         * @apiName GetNatures
         * @apiGroup Nature
         * @apiVersion 0.1.0
         *
         * @apiSuccess {Object[]} data Liste des natures.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": [
         *         { "id": 1, "nom": "Nature 1", "numero": "001" },
         *         { "id": 2, "nom": "Nature 2", "numero": "002" }
         *       ]
         *     }
         */
        Route::get('/','index');

        /**
         * @api {post} /nature/store Créer une nouvelle nature
         * @apiName StoreNature
         * @apiGroup Nature
         * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         * @apiBody {String} nom Nom de la nature.
         * @apiBody {String} numero Numéro de la nature.
         * @apiBody {json} descriptor fichier json de la nature.
         *
         * @apiSuccess {Object} data Détails de la nature créée.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *       "data": {
         *         "id": 1,
         *         "nom": "Nature 1",
         *         "numero": "001"
         *       }
         *     }
         */
        Route::post('/store','store');

        /**
         * @api {get} /nature/:id Afficher une nature
         * @apiName ShowNature
         * @apiGroup Nature
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID unique de la nature.
         *
         * @apiSuccess {Object} data Détails de la nature.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": {
         *         "id": 1,
         *         "nom": "Nature 1",
         *         "numero": "001"
         *       }
         *     }
         */
        Route::get('/{nature}','show');
    });
});

Route::prefix('depense')->middleware('auth:sanctum')->group(function () {
    Route::controller(DepenseController::class)->group(function () {
        /**
         * @api {get} /depense Liste des dépenses
         * @apiName GetDepenses
         * @apiGroup Depense
         * @apiVersion 0.1.0
         *
         * @apiSuccess {Object[]} data Liste des dépenses.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "data": [
         *         {
                    "id": 4,
                    "descriptor": {
                        "reason": "string",
                        "price": "int",
                        "totalKm": "float"
                    },
                    "note": {
                        "id": 1,
                        "commentaire": null,
                        "etat_id": null
                    },
                    "nature": {
                        "id": 1,
                        "commentaire": null,
                        "etat_id": null
                    },
                    "totalTTC": 50,
                    "date": "2003\/08\/06",
                    "tiers": "zeubiii"
         *         },
         *      ]
         *   }
         */
        Route::get('/','index');

        /**
         * @api {post} /depense/store Créer une nouvelle dépense
         * @apiName StoreDepense
         * @apiGroup Depense
         * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification

         * @apiBody {String} montant Montant de la dépense.
         * @apiBody {String} details Description de la dépense.
         * @apiBody {String} tiers Tiers de la.depense.
         * @apiBody {Date} date Date de la.depense.
         * @apiBody {Number} nature Nature de la.depense.
         * @apiBody {Number} note Note de la.depense.

         *
         * @apiSuccess {Object} data Détails de la dépense créée.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *  "data": {
         *     "id": 4,
         *          "descriptor": {
                    "reason": "string",
                    "price": "int",
                    "totalKm": "float"
                },
                "note": {
                    "id": 1,
                    "commentaire": null,
                    "etat_id": null
                },
                "nature": {
                    "id": 1,
                    "commentaire": null,
                    "etat_id": null
                },
                "totalTTC": 50,
                "date": "2003\/08\/06",
                "tiers": "zeubiii"
            }
        }
         */
        Route::post('/store','store');

        /**
         * @api {get} /depense/:id Afficher une dépense
         * @apiName ShowDepense
         * @apiGroup Depense
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID unique de la dépense.
         *
         * @apiSuccess {Object} data Détails de la dépense.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
                "data": {
                    "id": 4,
                    "descriptor": {
                        "reason": "string",
                        "price": "int",
                        "totalKm": "float"
                    },
                    "note": {
                        "id": 1,
                        "commentaire": null,
                        "etat_id": null
                    },
                    "nature": {
                        "id": 1,
                        "commentaire": null,
                        "etat_id": null
                    },
                    "totalTTC": 50,
                    "date": "2003\/08\/06",
                    "tiers": "zeubiii"
                }
            }
         */
        Route::get('/{depense}','show');

        /**
         * @api {put} /depenses/:id Mettre à jour une dépense
         * @apiName UpdateDepense
         * @apiDescription Mettre à jour une dépense inclu la remise en état de base la note de fraie affiliée
         * @apiGroup Depense
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID unique de la dépense.
         *
         * @apiBody {Number} totalTTC Montant total TTC de la dépense.
         * @apiBody {String} date Date de la dépense.
         * @apiBody {String} tiers Nom du tiers.
         * @apiBody {Number} nature_id ID de la nature de la dépense.
         * @apiBody {String} details Détails supplémentaires de la dépense (au format JSON).
         *
         * @apiSuccess {Object} data Détails de la dépense mise à jour.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *         "data": {
         *             "id": 4,
         *             "totalTTC": 50,
         *             "date": "2003-08-06",
         *             "tiers": "zeubiii",
         *             "nature_id": 1,
         *             "details": "{\"reason\":\"string\", \"price\":100, \"totalKm\":30.5}",
         *             "note": {
         *                 "id": 1,
         *                 "commentaire": null,
         *                 "etat_id": 1
         *             },
         *             "nature": {
         *                 "id": 1,
         *                 "commentaire": null,
         *                 "etat_id": null
         *             }
         *         }
         *     }
         *
         *
         * @apiError ValidationFailed Les données de la requête ne sont pas valides.
         * @apiErrorExample {json} Erreur:
         *     HTTP/1.1 400 Bad Request
         *     {
         *         "error": "Validation failed"
         *     }
         */
        Route::put('/{depense}', [DepenseController::class, 'update']);
    });
});

Route::prefix('note')->middleware('auth:sanctum')->group(function () {
    Route::controller(NoteController::class)->group(function () {
        /**
         * @api {get} /note Liste des notes
         * @apiName GetNotes
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiDescription Récupère la liste des notes de l'utilisateur connecté.
         * Vous pouvez ajouter un paramètre optionnel dabs l'url `etat` pour filtrer les notes en fonction de leur état. ( id de l'état )
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object[]} data Liste des notes.
         * @apiSuccess {Number} data.id ID unique de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id Informations sur l'état de la note.
         * @apiSuccess {Number} data.etat_id.id ID unique de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *         "data": [
         *             {
         *                 "id": 1,
         *                 "commentaire": null,
         *                 "etat_id": {
         *                     "id": 1,
         *                     "nom": "not validated",
         *                     "created_at": "2025-01-14T18:55:52.000000Z",
         *                     "updated_at": "2025-01-14T18:55:52.000000Z"
         *                 }
         *             }
         *         ]
         *     }
         */
        Route::get('/', 'index');


        /**
         * @api {get} /note/byValidator Liste des notes par validateur
         * @apiName GetNotesByValidator
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiDescription Récupère la liste des notes associées au validateur connecté.
         * Vous pouvez ajouter un paramètre optionnel `etat` pour filtrer les notes en fonction de leur état.
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object[]} data Liste des notes.
         * @apiSuccess {Number} data.id ID unique de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id Informations sur l'état de la note.
         * @apiSuccess {Number} data.etat_id.id ID unique de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *         "data": [
         *             {
         *                 "id": 1,
         *                 "commentaire": null,
         *                 "etat_id": {
         *                     "id": 1,
         *                     "nom": "not validated",
         *                     "created_at": "2025-01-14T18:55:52.000000Z",
         *                     "updated_at": "2025-01-14T18:55:52.000000Z"
         *                 }
         *             }
         *         ]
         *     }
         */
        Route::get('/byValidator','indexByValidator');

        /**
         * @api {get} /note/byControler Liste des notes par controler
         * @apiName GetNotesByControler
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiDescription Récupère la liste des notes associées au controleur connecté.
         * Vous pouvez ajouter un paramètre optionnel `etat` pour filtrer les notes en fonction de leur état.
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object[]} data Liste des notes.
         * @apiSuccess {Number} data.id ID unique de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id Informations sur l'état de la note.
         * @apiSuccess {Number} data.etat_id.id ID unique de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *         "data": [
         *             {
         *                 "id": 1,
         *                 "commentaire": null,
         *                 "etat_id": {
         *                     "id": 1,
         *                     "nom": "not validated",
         *                     "created_at": "2025-01-14T18:55:52.000000Z",
         *                     "updated_at": "2025-01-14T18:55:52.000000Z"
         *                 }
         *             }
         *         ]
         *     }
         */
        Route::get('/byControler','indexByControler');



        /**
         * @api {post} /note/store Créer une nouvelle note
         * @apiName StoreNote / store une note de frai, la retourne et ajoute un état de base et attribue la note au validateur
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiHeader {Bearer} token Token d'authentification
         * @apiBody {String} commentaire Contenu de la note.
         *
         * @apiSuccess {Object} data Détails de la note créée.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 201 Created
         *     {
         *       {
                    "id": 1,
                    "commentaire": null,
                    "etat_id": null
                }
         *   }
         */
        Route::post('/store','store');

        /**
         * @api {get} /note/:id Afficher une note
         * @apiName ShowNote
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID unique de la note.
         *
         * @apiSuccess {Object} data Détails de la note.
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       {
                    "id": 1,
                    "commentaire": null,
                    "etat_id": null
                }
         *    }
         */
        Route::get('/{note}','show');

        /**
         * @api {post} /note/:id/validate Valider une note de frais
         * @apiName ValidateNote
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de la note de frais à valider.
         *
         * @apiSuccess {String} message Message de confirmation.
         * @apiSuccess {Object} data Données de la note mise à jour.
         * @apiSuccess {Number} data.id ID de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id État de la note.
         * @apiSuccess {Number} data.etat_id.id ID de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "message": "Note has been validated and marked as 'not controlled'.",
         *       "data": {
         *           "id": 1,
         *           "commentaire": null,
         *           "etat_id": {
         *               "id": 2,
         *               "nom": "not controlled",
         *               "created_at": "2025-01-14T18:55:52.000000Z",
         *               "updated_at": "2025-01-14T18:55:52.000000Z"
         *           }
         *       }
         *     }
         *

         * @apiError NotAuthorized Vous n'êtes pas le validateur de cette note.
         * @apiErrorExample {json} Non autorisé:
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "message": "You are not the validator of this note."
         *     }
         */
        Route::post('/{note}/validate', 'validate');

        /**
         * @api {post} /note/:id/reject Rejeter une note de frais
         * @apiName RejectNote
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de la note de frais à valider.
         *
         * @apiSuccess {String} message Message de confirmation.
         * @apiSuccess {Object} data Données de la note mise à jour.
         * @apiSuccess {Number} data.id ID de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id État de la note.
         * @apiSuccess {Number} data.etat_id.id ID de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "message": "Note has been rejected and marked as 'not controlled'.",
         *       "data": {
         *           "id": 1,
         *           "commentaire": null,
         *           "etat_id": {
         *               "id": 3,
         *               "nom": "not controlled",
         *               "created_at": "2025-01-14T18:55:52.000000Z",
         *               "updated_at": "2025-01-14T18:55:52.000000Z"
         *           }
         *       }
         *     }
         *

         * @apiError NotAuthorized Vous n'êtes pas le validateur de cette note.
         * @apiErrorExample {json} Non autorisé:
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "message": "You are not the validator of this note."
         *     }
         */
        Route::post('/{note}/reject', 'reject');

        /**
         * @api {post} /note/:id/cancel Annuler une note de frais
         * @apiName CancelNote
         * @apiGroup Note
         * @apiVersion 0.1.0
         *
         * @apiParam {Number} id ID de la note de frais à valider.
         *
         * @apiSuccess {String} message Message de confirmation.
         * @apiSuccess {Object} data Données de la note mise à jour.
         * @apiSuccess {Number} data.id ID de la note.
         * @apiSuccess {String} data.commentaire Commentaire de la note.
         * @apiSuccess {Object} data.etat_id État de la note.
         * @apiSuccess {Number} data.etat_id.id ID de l'état.
         * @apiSuccess {String} data.etat_id.nom Nom de l'état.
         * @apiSuccess {String} data.etat_id.created_at Date de création de l'état.
         * @apiSuccess {String} data.etat_id.updated_at Date de mise à jour de l'état.
         *
         * @apiSuccessExample {json} Succès:
         *     HTTP/1.1 200 OK
         *     {
         *       "message": "Note has been canceled and marked as 'not controlled'.",
         *       "data": {
         *           "id": 1,
         *           "commentaire": null,
         *           "etat_id": {
         *               "id": 4,
         *               "nom": "not controlled",
         *               "created_at": "2025-01-14T18:55:52.000000Z",
         *               "updated_at": "2025-01-14T18:55:52.000000Z"
         *           }
         *       }
         *     }
         *

         * @apiError NotAuthorized Vous n'êtes pas le validateur de cette note.
         * @apiErrorExample {json} Non autorisé:
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "message": "You are not the validator of this note."
         *     }
         */
        Route::post('/{note}/cancel', 'cancel');

    });
});
    

