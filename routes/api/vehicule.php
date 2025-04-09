<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;

Route::prefix('vehicule')->middleware('auth:sanctum')->group(function () {
    Route::controller(VehiculeController::class)->group(function () {
        /**
         * @api {get} /vehicule Vehicles
         * @apiName GetVehicles
         * @apiDescription Returns the list of all vehicles.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiSuccess {Object} data List of vehicle resources.
         */
        Route::get('/', 'index');

        /**
         * @api {post} /vehicule/store Create Vehicle
         * @apiName StoreVehicle
         * @apiDescription Creates a new vehicle with optional carte grise file.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiBody {String} name Vehicle name
         * @apiBody {String} model Vehicle model
         * @apiBody {String} brand Vehicle brand
         * @apiBody {Date} date Vehicle date
         * @apiBody {File} carte_grise Vehicle registration document (optional)
         * @apiBody {Number} profil_id Profile ID (optional)
         *
         * @apiSuccess {Object} data Created vehicle resource
         */
        Route::post('/store', 'store');

        /**
         * @api {get} /vehicule/:id Vehicle
         * @apiName GetVehicle
         * @apiDescription Returns a specific vehicle resource.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiParam {Number} id Vehicle ID
         *
         * @apiSuccess {Object} data Vehicle resource
         */
        Route::get('/{vehicule}', 'show');

        /**
         * @api {put} /vehicule/:id Update Vehicle
         * @apiName UpdateVehicle
         * @apiDescription Updates a vehicle's information.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiParam {Number} id Vehicle ID
         *
         * @apiBody {String} name Vehicle name (optional)
         * @apiBody {String} model Vehicle model (optional)
         * @apiBody {String} brand Vehicle brand (optional)
         * @apiBody {Date} date Vehicle date (optional)
         * @apiBody {File} carte_grise Vehicle registration document (optional)
         * @apiBody {Number} profil_id Profile ID (optional)
         *
         * @apiSuccess {Object} data Updated vehicle resource
         */
        Route::post('/{vehicule}', 'update');

        /**
         * @api {get} /vehicule/getfile/:id/:filename Vehicle File
         * @apiName GetVehicleFile
         * @apiDescription Returns a vehicle's file if it exists.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiParam {Number} id Vehicle ID
         * @apiParam {String} filename File name
         *
         * @apiSuccess {File} file Vehicle file
         */
        Route::get('/getfile/{vehicule}/{filename}', 'getFile');

        /**
         * @api {delete} /vehicule/:id Delete Vehicle
         * @apiName DeleteVehicle
         * @apiDescription Deletes a vehicle resource.
         * @apiGroup Vehicle
         * @apiVersion 1.0.1
         *
         * @apiHeader {Bearer} token Authentication token
         *
         * @apiParam {Number} id Vehicle ID
         *
         * @apiSuccess {Object} data Deleted vehicle resource
         */
        Route::delete('/{vehicule}', 'destroy');
    });


}); 