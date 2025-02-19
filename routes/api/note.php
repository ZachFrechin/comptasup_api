<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::prefix('note')->middleware('auth:sanctum')->group(function () {
    Route::controller(NoteController::class)->group(function () {
        /**
         * @api {get} /note Notes
         * @apiName GetNotes
         * @apiGroup Note
         * @apiVersion 1.0.1
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
         * @apiParam {Number} id ID de la note de frais à rejeter.
         *
         * @apiBody {comment} comment Commentaire de la note (optionel).
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
         * @apiParam {Number} id ID de la note de frais à annuler.
         * @apiBody {comment} comment Commentaire de la note (optionel).
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

        Route::post('/{note}/control', 'control');

    });
});
