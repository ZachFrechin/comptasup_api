<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        /**
         * @api {get} /user/ Users
         * @apiName GetUserList
         * @apiDescription Retourne les ressources de la liste des utilisateurs.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         *  @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Ressource des utilisateurs.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    [
                        {
                            "id": 1,
                            "email": "administrateur@exemple.com",
                            "nom": "Trépanier",
                            "prenom": "Alexis",
                            "naissance": "1958-02-12",
                            "telephone": "0612345678",
                            "code_postal": "73000",
                            "ville": "Chambéry",
                            "pays": "France",
                            "rue": "Rue des Elephants",
                            "numero_de_rue": 1,
                            "ressource": null,
                            "roles":
                            [
                                {
                                    "id": 1,
                                    "nom": "Salarié",
                                    "color": null,
                                    "permissions": []
                                },
                                {
                                    "id": 5,
                                    "nom": "Administrateur",
                                    "color": null,
                                    "permissions":
                                    [
                                        {
                                            "id": 11,
                                            "nom": "administrator"
                                        }
                                    ]
                                }
                            ],
                            "vehicules": [],
                            "trajets": [],
                            "date_ajout": "2025-02-19T14:03:28.000000Z",
                            "derniere_modification": "2025-02-19T14:03:28.000000Z",
                            "statut": 1,
                            "service":
                            {
                                "id": 1,
                                "nom": "Comptabilité",
                                "description": "Service de comptabilité",
                                "numero": "1",
                                "created_at": "2025-02-19T14:03:28.000000Z",
                                "updated_at": "2025-02-19T14:03:28.000000Z"
                            }
                        }
                    ]
                }
         */
        Route::get('/', 'index');

        /**
         * @api {get} /user/:id User
         * @apiName GetUser
         * @apiDescription Retourne la ressource d'un user.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de l'user.
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        }
                    }
                }
         */
        Route::get('/{user}', 'show');

        /**
         * @api {post} /user/store Créer User
         * @apiName CreateUser
         * @apiDescription Sauve un user en base.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} email Email de l'user
         * @apiBody {String} password Mot de passe de l'user
         * @apiBody {array} profil !!! Contient tout les champs autre que roles, password, et email !!!
         * @apiBody {String} nom Nom de l'user
         * @apiBody {String} prenom Prénom de l'user
         * @apiBody {Date} naissance Date de naissance de l'user
         * @apiBody {String} telephone Numéro de téléphone de l'user
         * @apiBody {String} code_postal Code postal de l'user ( optionel )
         * @apiBody {String} ville Ville de l'user ( optionel )
         * @apiBody {String} pays Pays de l'user ( optionel )
         * @apiBody {String} rue Rue de l'user ( optionel )
         * @apiBody {String} numero_de_rue Numéro de rue de l'user ( optionel )
         * @apiBody {array:int} roles ID des roles de l'user ( cf. Role )
         *
         * @apiSuccess {Object} data Ressource de l'user crée.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        }
                    }
                }
         */
        Route::post('/store', 'store');

        /**
         * @api {put} /user/updatePassword Mettre à jour Mot de passe User
         * @apiName UpdateUserPassword
         * @apiDescription Met à jour le mot de passe de l'user en base.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} old_password Mot de passe actuel de l'user
         * @apiBody {String} password Nouveau mot de passe de l'user
         * @apiBody {String} password_confirmation Confirmation du nouveau mot de passe de l'user
         * */
        Route::put('/updatePassword', 'updatePassword');

        /**
         * @api {put} /user/update/:id Mettre à jour User
         * @apiName UpdateUser
         * @apiDescription Met à jour un user en base ( ne comprend pas les roles ).
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de l'utilisateur.
         *
         * @apiBody {String} email Email de l'user
         * @apiBody {String} password Mot de passe de l'user
         * @apiBody {array} profil !!! Contient tout les champs autre que roles, password, et email !!!
         * @apiBody {String} nom Nom de l'user
         * @apiBody {String} prenom Prénom de l'user
         * @apiBody {Date} naissance Date de naissance de l'user
         * @apiBody {String} telephone Numéro de téléphone de l'user
         * @apiBody {String} code_postal Code postal de l'user ( optionel )
         * @apiBody {String} ville Ville de l'user ( optionel )
         * @apiBody {String} pays Pays de l'user ( optionel )
         * @apiBody {String} rue Rue de l'user ( optionel )
         * @apiBody {String} numero_de_rue Numéro de rue de l'user ( optionel )
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        }
                    }
                }
         */
        Route::put('/{user}', 'update');

        /**
         * @api {delete} /user/destroy/:id Supprimer User
         * @apiName DeleteUser
         * @apiDescription Supprime un user en base.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de l'user.
         *
         * @apiBody {Number} id ID de l'user.
         *
         * @apiSuccess {Object} data Message de retour.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "message": "L'user a bien été supprimé."
                    }
                }
         */
        Route::delete('/{user}', 'destroy');

        /**
         * @api {put} /user/updateRole/:id Mettre à jour Role User
         * @apiName UpdateUserRole
         * @apiDescription Met à jour les roles de l'user en base ( cf. Role ).
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de l'user.
         *
         * @apiBody {array:int} roles ID des roles de l'user ( cf. Role ).
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        }
                    }
                }
         */
        Route::put('/updateRole/{user}', 'updateRole');

        /**
         * @api {delete} /user/deleteRole/:id Supprimer Role User
         * @apiDescription Supprime un role de l'user en base ( cf. Role ).
         * @apiName DeleteUserRole
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de l'user.
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        }
                    }
                }
         */
        Route::delete('/deleteRole/{user}', 'deleteRole');

        /**
         * @api {put} /user/addValideur/:user/:valideur Ajouter un valideur
         * @apiName AddValideur
         * @apiDescription Ajoute un valideur à un user.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} user ID unique de l'user.
         * @apiParam {Number} valideur ID unique du valideur.
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        },
                        "affiliés": [USER-RESOURCE]
                    }
                }
         */
        Route::put('/addValideur/{user}/{valideur}', 'addValideur');

        /**
         * @api {delete} /user/removeValideur/:user Supprimer un valideur
         * @apiName RemoveValideur
         * @apiDescription Retire le valideur qui s'occupe de l'user.
         * @apiGroup User
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} user ID unique de l'user.
         *
         * @apiSuccess {Object} data Ressource de l'user.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 1,
                        "email": "administrateur@exemple.com",
                        "nom": "Trépanier",
                        "prenom": "Alexis",
                        "naissance": "1958-02-12",
                        "telephone": "0612345678",
                        "code_postal": "73000",
                        "ville": "Chambéry",
                        "pays": "France",
                        "rue": "Rue des Elephants",
                        "numero_de_rue": 1,
                        "ressource": null,
                        "roles":
                        [
                            {
                                "id": 1,
                                "nom": "Salarié",
                                "color": null,
                                "permissions": []
                            },
                            {
                                "id": 5,
                                "nom": "Administrateur",
                                "color": null,
                                "permissions":
                                [
                                    {
                                        "id": 11,
                                        "nom": "administrator"
                                    }
                                ]
                            }
                        ],
                        "vehicules": [],
                        "trajets": [],
                        "date_ajout": "2025-02-19T14:03:28.000000Z",
                        "derniere_modification": "2025-02-19T14:03:28.000000Z",
                        "statut": 1,
                        "service":
                        {
                            "id": 1,
                            "nom": "Comptabilité",
                            "description": "Service de comptabilité",
                            "numero": "1",
                            "created_at": "2025-02-19T14:03:28.000000Z",
                            "updated_at": "2025-02-19T14:03:28.000000Z"
                        },
                        "affiliés": [USER-RESOURCE]
                    }
                }
        */
        Route::delete('/removeValideur/{user}', 'removeValideur');

    });
});
