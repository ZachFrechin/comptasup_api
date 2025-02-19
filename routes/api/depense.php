<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepenseController;

Route::prefix('depense')->middleware('auth:sanctum')->group(function () {
    Route::controller(DepenseController::class)->group(function () {
        /**
         * @api {get} /depense Dépenses Utilisateur
         * @apiName GetUserDepense
         * @apiDescription Retourne la liste des ressources des dépense utilisateur.
         * @apiGroup Depense
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiSuccess {Object} data Liste des resources des dépenses.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    [
                        {
                            "id": 1,
                            "details": "{\"test\": \"test\"}",
                            "note": null,
                            "nature": null,
                            "totalTTC": "20",
                            "date": "2022-02-02",
                            "tiers": null,
                            "SIRET": null,
                            "fichiers": []
                        }
                    ]
                }
         */
        Route::get('/','index');

        /**
         * @api {post} /depense/store Créer dépense
         * @apiName StoreDepense
         * @apiDescription Sauve une nouvelle dépense en base, en l'attachant à une Note et une Nature.
         * @apiGroup Depense
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification

         * @apiBody {float} totalTTC Montant de la dépense toute taxe comprise.
         * @apiBody {Json:string} details Description de la dépense au format JSON stringify ( correspondante à la nature cf. Nature ).
         * @apiBody {String} tiers Tiers de la.depense.
         * @apiBody {Date} date Date de la.depense.
         * @apiBody {Number} nature_id ID de la Nature de la.depense cf. Nature.
         * @apiBody {Number} note_id ID de la Note de la.depense cf. Note.
         *
         * @apiSuccess {Object} data Resource de la dépense créée.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 Created
                {
                    "data":
                    {
                        "id": 3,
                        "details": "{}",
                        "note": 1,
                        "nature":
                        {
                            "id": 1,
                            "nom": "Autre",
                            "descriptor": "{\"file\": {\"ext\": [\"image\/png\", \"image\/jpeg\", \"application\/pdf\"], \"size\": 10, \"type\": \"file\", \"title\": \"Ticket\", \"position\": 0, \"required\": true}}",
                            "user": {}
                        },
                        "totalTTC": 2,
                        "date": "2022\/02\/02",
                        "tiers": "axa",
                        "SIRET": "85521452569854",
                        "fichiers": []
                    }
                }
        */
        Route::post('/store','store');

        /**
         * @api {get} /depense/:id Dépense
         * @apiDescription Retourne la ressource d'une dépense utilisateur.
         * @apiName getDepense
         * @apiGroup Depense
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de la dépense.
         *
         * @apiSuccess {Object} data Ressource de la dépense.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {
                    "data":
                    {
                        "id": 1,
                        "details": "{\"test\": \"test\"}",
                        "note": null,
                        "nature": null,
                        "totalTTC": "20",
                        "date": "2022-02-02",
                        "tiers": null,
                        "SIRET": null,
                        "fichiers": []
                    }
                }
         */
        Route::get('/{depense}','show');

        /**
         * @api {put} /depenses/:id Mettre à jour dépense
         * @apiName UpdateDepense
         * @apiDescription Met à jour une dépense en base, en modifiant son état cf. Etat.
         * @apiGroup Depense
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de la dépense.
         *
         * @apiBody {float} totalTTC Montant de la dépense toute taxe comprise.
         * @apiBody {Json:string} details Description de la dépense au format JSON stringify ( correspondante à la nature cf. Nature ).
         * @apiBody {String} tiers Tiers de la.depense.
         * @apiBody {Date} date Date de la.depense.
         * @apiBody {Number} nature_id ID de la Nature de la.depense cf. Nature.
         * @apiBody {Number} note_id ID de la Note de la.depense cf. Note.
         *
         * @apiSuccess {Object} data Ressource de la dépense.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 201 OK
                {
                    "data":
                    {
                        "id": 1,
                        "details": "{}",
                        "note": null,
                        "nature":
                        {
                            "id": 1,
                            "nom": "Autre",
                            "descriptor": "{\"file\": {\"ext\": [\"image\/png\", \"image\/jpeg\", \"application\/pdf\"], \"size\": 10, \"type\": \"file\", \"title\": \"Ticket\", \"position\": 0, \"required\": true}}",
                            "user": {}
                        },
                        "totalTTC": 2,
                        "date": "2022\/02\/02",
                        "tiers": "aaaaaaaaaaa",
                        "SIRET": null,
                        "fichiers": []
                    }
                }
         */
        Route::post('/{depense}', [DepenseController::class, 'update']);

        /**
         * @api {put} /depense/getFile/:id/:name Fichier dépense
         * @apiName GetFileDepense
         * @apiDescription Renvoie le fichier d'une dépense si le nom est bon et que le fichier existe.
         * @apiGroup Depense
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Token d'authentification
         *
         * @apiParam {Number} id ID unique de la dépense.
         * @apiParam {String} name Nom du fichier desiré.
         *
         * @apiSuccess {File} file Fichier de la dépense.
         * @apiSuccessExample {json} Succès:
                HTTP/1.1 200 OK
                {}
         */
        Route::get("/getfile/{depense}/{filename}", [DepenseController::class, 'getFile']);
    });
});
