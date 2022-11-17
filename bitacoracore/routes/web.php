<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get("/", function () {
    return redirect("home");
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //rutas get para modulos
    Route::get('puestos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('puestos');
    Route::get('empleados', [App\Http\Controllers\ProyectosController::class, 'index'])->name('empleados');
    Route::get('tipos-vehiculos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('tipos-vehiculos');
    Route::get('administradores', [App\Http\Controllers\ProyectosController::class, 'index'])->name('administradores');
    Route::get('roles', [App\Http\Controllers\ProyectosController::class, 'index'])->name('roles');
    Route::get('registro-visitantes', [App\Http\Controllers\ProyectosController::class, 'index'])->name('registro-visitantes');

    Route::get('proyectos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('proyectos');
    Route::get('bitacora', [App\Http\Controllers\BitacoraController::class, 'index'])->name('bitacora');
    Route::get('admin-user', [App\Http\Controllers\AdminUserController::class, 'index'])->name('adminusers');

    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');

    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

    Route::group(["middleware" => 'permiso'], function () {
        Route::get('requerimientos/ver-ticket/', [App\Http\Controllers\RequerimientosController::class, 'displayTicket']);
        Route::get('gestion-tickets', [App\Http\Controllers\GestionTicketsController::class, 'index'])->name('gestiontickets');
        Route::get('requerimientos', [App\Http\Controllers\RequerimientosController::class, 'index'])->name('requerimientos');
    });

    //Gestion de Tickets
    Route::get('gestion-tickets/getTickets', [App\Http\Controllers\GestionTicketsController::class, 'getTickets']);
    Route::get('gestion-tickets/create', [App\Http\Controllers\GestionTicketsController::class, 'create']);
    Route::post("gestion-tickets", [App\Http\Controllers\GestionTicketsController::class, "store"]);
    Route::post("gestion-tickets/{id}/edit", [App\Http\Controllers\GestionTicketsController::class, "edit"]);
    Route::delete("gestion-tickets/{id}", [App\Http\Controllers\GestionTicketsController::class, "destroy"]);

    //Administracion de usuarios
    Route::get('admin-user/getUsers', [App\Http\Controllers\AdminUserController::class, 'getUsers']);
    Route::post('admin-user', [App\Http\Controllers\AdminUserController::class, 'store']);
    Route::get("admin-user/{id}/edit", [App\Http\Controllers\AdminUserController::class, "edit"]);
    Route::put('admin-user', [App\Http\Controllers\AdminUserController::class, 'update']);
    Route::delete("admin-user/{id}", [App\Http\Controllers\AdminUserController::class, "destroy"]);
    Route::post("admin-user/reset-password", [App\Http\Controllers\AdminUserController::class, "resetPassword"]);

    //bitacora
    Route::get('bitacora/consulta-bitacora', [App\Http\Controllers\BitacoraController::class, 'consultaBitacora']);
    Route::get("bitacora/actualizar", [App\Http\Controllers\BitacoraController::class, "actualizarBitacora"]);

    //Requerimientos
    Route::get('requerimientos/getRequerimientos', [App\Http\Controllers\RequerimientosController::class, 'getRequerimientos']);
    Route::post('requerimientos/ver-ticket/{id}/getTicket', [App\Http\Controllers\RequerimientosController::class, 'getTicket']);
    Route::put('requerimientos/ver-ticket', [App\Http\Controllers\RequerimientosController::class, 'update']);

});
