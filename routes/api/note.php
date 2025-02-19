<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::prefix('note')->middleware('auth:sanctum')->group(function () {
    Route::controller(NoteController::class)->group(function () {
        /**
         * @api {get} /note Notes Utilisateur
         * @apiName GetNotes
         * @apiDescription Retourne la liste des ressources des notes utilisateur.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object} data Ressources des notes.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": [
                        {
                            "id": 1,
                            "commentaire": null,
                            "nom": "nom",
                            "etat": {
                                "id": 1,
                                "nom": "not validated",
                                "created_at": "2025-02-19T14:03:29.000000Z",
                                "updated_at": "2025-02-19T14:03:29.000000Z"
                            },
                            "user_id": 3,
                            "depenses": [],
                            "totalTTC": 0,
                            "controleur_id": null,
                            "validateur_id": 4
                        }
                    ]
                }
         */
        Route::get('/', 'index');

        /**
         * @api {get} /note/byValidator Note Valideur
         * @apiName GetNotesByValideur
         * @apiDescription Retourn les ressources des notes en fonction du valideur connecté ( vide si l'utilisateur n'est pas un valideur ).
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object} data Ressources des notes.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": [
                        {
                            "id": 1,
                            "commentaire": null,
                            "nom": "nom",
                            "etat": {
                                "id": 1,
                                "nom": "not validated",
                                "created_at": "2025-02-19T14:03:29.000000Z",
                                "updated_at": "2025-02-19T14:03:29.000000Z"
                            },
                            "user_id": 3,
                            "depenses": [],
                            "totalTTC": 0,
                            "controleur_id": null,
                            "validateur_id": 4
                        }
                    ]
                }
         */
        Route::get('/byValideur','indexByValidator');

        /**
         * @api {get} /note/byControler Note Controleur
         * @apiName GetNotesByControleur
         * @apiDescription Renvoie la liste des ressources des notes en fonction du controleur connecté ( vide si l'utilisateur n'est pas un controleur ).
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} [etat] ID de l'état pour filtrer les notes (optionnel).
         *
         * @apiSuccess {Object} data Ressources des notes.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": [
                        {
                            "id": 1,
                            "commentaire": null,
                            "nom": null,
                            "etat": {
                                "id": 4,
                                "nom": "not_controled",
                                "created_at": "2025-02-19T14:03:29.000000Z",
                                "updated_at": "2025-02-19T14:03:29.000000Z"
                            },
                            "user_id": 3,
                            "depenses": [],
                            "totalTTC": 0,
                            "controleur_id": 3,
                            "validateur_id": 4
                        }
                    ]
                }
         */
        Route::get('/byControleur','indexByControler');



        /**
         * @api {post} /note/store Créer Note
         * @apiName StoreNote
         * @apiDescription Sauve une note en base, et lui attribut par default un valideur ( cf. valideur_id )
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiBody {String} nom Nom de la note
         * @apiBody {String} commentaire Contenu de la note ( optionel )
         *
         * @apiSuccess {Object} data Ressource de la note créée.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 Created
                {
                    "data": {
                        "id": 2,
                        "commentaire": null,
                        "nom": "nom",
                        "etat": {
                            "id": 1,
                            "nom": "not validated",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": null,
                        "validateur_id": 4
                    }
                }
         */
        Route::post('/store','store');

        /**
         * @api {get} /note/:id Note
         * @apiName GetNote
         * @apiDescription Retourne la ressource d'une note utilisateur.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de la note.
         *
         * @apiSuccess {Object} data Ressource de la note.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "commentaire": null,
                        "nom": "nom",
                        "etat":
                        {
                            "id": 4,
                            "nom": "not_controled",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": 3,
                        "validateur_id": 4
                    }
                }
         */
        Route::get('/{note}','show');

        /**
         * @api {post} /note/:id/validate Valider Note
         * @apiName ValidateNote
         * @apiDescription Valide une note en modifiant son état en base.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID de la note à valider.
         *
         * @apiSuccess {Object} data Ressource de la note.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": "Note has been validated and marked as not controlled",
                    "note":
                    {
                        "id": 1,
                        "commentaire": null,
                        "nom": "nom",
                        "etat":
                        {
                            "id": 4,
                            "nom": "not_controled",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": 3,
                        "validateur_id": 4
                    }
                }
         */
        Route::post('/{note}/validate', 'validate');

        /**
         * @api {post} /note/:id/reject Rejeter Note
         * @apiName RejectNote
         * @apiDescription Rejete une note en modifiant son état en base.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID de la note de frais à rejeter
         *
         * @apiBody {comment} comment Commentaire de la note ( optionel )
         *
         * @apiSuccess {Object} data Ressource de la note.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": "Note has been rejected and marked as rejected",
                    "note":
                    {
                        "id": 1,
                        "commentaire": null,
                        "nom": "nom",
                        "etat":
                        {
                            "id": 2,
                            "nom": "rejected",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": 3,
                        "validateur_id": 4
                    }
                }
         */
        Route::post('/{note}/reject', 'reject');

        /**
         * @api {post} /note/:id/cancel Annuler Note
         * @apiName CancelNote
         * @apiDescription Annule une note en modifiant son état en base.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID de la note de frais à annuler.
         *
         * @apiBody {comment} comment Commentaire de la note ( optionel )
         *
         * @apiSuccess {Object} data Ressource de la note.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": "Note has been canceled and marked as canceled",
                    "note":
                    {
                        "id": 1,
                        "commentaire": null,
                        "nom": "nom",
                        "etat":
                        {
                            "id": 3,
                            "nom": "canceled",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": 3,
                        "validateur_id": 4
                    }
                }
         */
        Route::post('/{note}/cancel', 'cancel');

        /**
         * @api {post} /note/:id/control Controler Note
         * @apiName ControlNote
         * @apiDescription Controle positivement une note en modifiant son état en base.
         * @apiGroup Note
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID de la note de frais à controler.
         *
         * @apiBody {comment} comment Commentaire de la note ( optionel )
         *
         * @apiSuccess {Object} data Ressource de la note.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data": "Note has been controlled and marked as validated",
                    "note":
                    {
                        "id": 1,
                        "commentaire": null,
                        "nom": "nom",
                        "etat":
                        {
                            "id": 5,
                            "nom": "validated",
                            "created_at": "2025-02-19T14:03:29.000000Z",
                            "updated_at": "2025-02-19T14:03:29.000000Z"
                        },
                        "user_id": 3,
                        "depenses": [],
                        "totalTTC": 0,
                        "controleur_id": 3,
                        "validateur_id": 4
                    }
                }
         */
        Route::post('/{note}/control', 'control');

    });
});
