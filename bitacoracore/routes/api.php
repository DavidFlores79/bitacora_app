<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("login", [App\Http\Controllers\Api\AuthController::class, "login"]); //login usuarios


Route::post("usuario", [App\Http\Controllers\Api\AuthController::class, "getAuthenticatedUser"]); //login usuarios


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(["middleware" => ["auth:api"]], function () {

    Route::prefix('v1')->group(function () {

        Route::get("user", [App\Http\Controllers\Api\UserController::class, "getUser"]);
        Route::post("sync", [App\Http\Controllers\Api\SyncController::class, "syncVisitas"]);


    });
    
    Route::post("logout", [App\Http\Controllers\Api\AuthController::class, "logout"]); //logout usuarios
});