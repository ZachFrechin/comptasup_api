<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteHistoryController;

Route::prefix('noteHistory')->middleware('auth:sanctum')->group(function ()
{
    Route::controller(NoteHistoryController::class)->group(function ()
    {
        /**
         * @api {post} /noteHistory/:id NoteHistories
         * @apiName GetNoteHistories
         * @apiDescription Renvoie les ressource d'historique d'une note.
         * @apiGroup NoteHistory
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID de la note pour l'historique désiré.
         *
         * @apiSuccess {Object} data Ressource de l'historique.
         *
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                   "data":
                   [
                        {
                            "user":
                            {
                                "id": 3,
                                "email": "controleur@exemple.com",
                                "nom": "Archaimbau",
                                "prenom": "Grégoire",
                                "naissance": "2001-04-04",
                                "telephone": "0612345678",
                                "code_postal": "73000",
                                "ville": "Chambéry",
                                "pays": "France",
                                "rue": "Rue des Poissons",
                                "numero_de_rue": 1,
                                "ressource": null,
                                "roles":
                                [
                                    {
                                        "id": 1,
                                        "nom": "Employé",
                                        "color": null,
                                        "permissions": []
                                    },
                                    {
                                        "id": 3,
                                        "nom": "Controlleur",
                                        "color": null,
                                        "permissions":
                                        [
                                            {
                                                "id": 6,
                                                "nom": "select_users"
                                            }
                                        ]
                                    }
                                ],
                                "vehicules": [],
                                "trajets": [],
                                "date_ajout": "2025-02-19T14:03:29.000000Z",
                                "derniere_modification": "2025-02-19T14:03:29.000000Z",
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
                            },
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
                            },
                            "baseEtat":
                            {
                                "id": 4,
                                "nom": "not_controled",
                                "created_at": "2025-02-19T14:03:29.000000Z",
                                "updated_at": "2025-02-19T14:03:29.000000Z"
                            },
                            "finalEtat":
                            {
                                "id": 4,
                                "nom": "not_controled",
                                "created_at": "2025-02-19T14:03:29.000000Z",
                                "updated_at": "2025-02-19T14:03:29.000000Z"
                            }
                        },
                    ]
                }
         */
        Route::get('/{note}', 'getNoteHistory');
    });
});


