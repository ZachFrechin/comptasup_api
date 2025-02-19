<?php

use App\Http\Controllers\AuthController;

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






    
