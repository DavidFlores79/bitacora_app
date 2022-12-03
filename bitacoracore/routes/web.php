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
    Route::get('get-profile-code', [App\Http\Controllers\HomeController::class, 'getProfileCode']);

    //rutas get para modulos
    Route::get('visitas', [App\Http\Controllers\VisitaController::class, 'index'])->name('visitas');
    Route::get('registro-visitantes', [App\Http\Controllers\VisitaController::class, 'registroVisitantes'])->name('registro-visitantes');
    Route::get('bitacora', [App\Http\Controllers\BitacoraController::class, 'index'])->name('bitacora');
    Route::get('admin-user', [App\Http\Controllers\AdminUserController::class, 'index'])->name('adminusers');

    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::get('roles', [App\Http\Controllers\ProyectosController::class, 'index'])->name('roles');

    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

    // Route::group(["middleware" => 'permiso'], function () {
    //     Route::get('requerimientos/ver-ticket/', [App\Http\Controllers\RequerimientosController::class, 'displayTicket']);
    //     Route::get('gestion-tickets', [App\Http\Controllers\GestionTicketsController::class, 'index'])->name('gestiontickets');
    //     Route::get('requerimientos', [App\Http\Controllers\RequerimientosController::class, 'index'])->name('requerimientos');
    // });

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

    //Visitas
    Route::get('visitas/getVisitas', [App\Http\Controllers\VisitaController::class, 'getVisitas']);

        //tipo campos
        Route::get('tipo-vehiculos', [App\Http\Controllers\TipoVehiculoController::class, 'index'])->name('tipo-vehiculos');
        Route::get('tipo-vehiculos/getinfo', [App\Http\Controllers\TipoVehiculoController::class, 'getInfo']);
        Route::get('tipo-vehiculos/create', [App\Http\Controllers\TipoVehiculoController::class, 'create']);
        Route::get('tipo-vehiculos/edit', [App\Http\Controllers\TipoVehiculoController::class, 'edit']);
        Route::post('tipo-vehiculos', [App\Http\Controllers\TipoVehiculoController::class, 'store']);
        Route::put('tipo-vehiculos', [App\Http\Controllers\TipoVehiculoController::class, 'update']);
        Route::delete("tipo-vehiculos/{id}", [App\Http\Controllers\TipoVehiculoController::class, "destroy"]);

        //tipo campos
        Route::get('perfiles', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfiles');
        Route::get('perfiles/getinfo', [App\Http\Controllers\PerfilController::class, 'getInfo']);
        Route::get('perfiles/create', [App\Http\Controllers\PerfilController::class, 'create']);
        Route::get('perfiles/edit', [App\Http\Controllers\PerfilController::class, 'edit']);
        Route::post('perfiles', [App\Http\Controllers\PerfilController::class, 'store']);
        Route::put('perfiles', [App\Http\Controllers\PerfilController::class, 'update']);
        Route::delete("perfiles/{id}", [App\Http\Controllers\PerfilController::class, "destroy"]);
        //tipo campos

        //Empleados
        Route::get('empleados', [App\Http\Controllers\UserController::class, 'indexEmpleado'])->name('empleados');
        Route::get('empleados/getempleados', [App\Http\Controllers\UserController::class, 'getEmpleados']);
        Route::get('empleados/create', [App\Http\Controllers\UserController::class, 'create']);
        Route::get('empleados/edit', [App\Http\Controllers\UserController::class, 'edit']);
        Route::post('empleados', [App\Http\Controllers\UserController::class, 'store']);
        Route::put('empleados', [App\Http\Controllers\UserController::class, 'update']);
        Route::delete("empleados/{id}", [App\Http\Controllers\UserController::class, "destroy"]);

        //Administradores
        Route::get('administradores', [App\Http\Controllers\UserController::class, 'indexAdmin'])->name('administradores');
        Route::get('administradores/getadmin', [App\Http\Controllers\UserController::class, 'getAdmin']);
        Route::get('administradores/create', [App\Http\Controllers\UserController::class, 'create']);
        Route::get('administradores/edit', [App\Http\Controllers\UserController::class, 'edit']);
        Route::post('administradores', [App\Http\Controllers\UserController::class, 'store']);
        Route::put('administradores', [App\Http\Controllers\UserController::class, 'update']);
        Route::delete("administradores/{id}", [App\Http\Controllers\UserController::class, "destroy"]);
        
        
        
        //visitas
        Route::get('visitas/create', [App\Http\Controllers\VisitaController::class, 'create']);
        Route::get('visitas/edit', [App\Http\Controllers\VisitaController::class, 'edit']);
        Route::post('visitas', [App\Http\Controllers\VisitaController::class, 'store']);
        Route::put('visitas', [App\Http\Controllers\VisitaController::class, 'update']);
        Route::delete("visitas/{id}", [App\Http\Controllers\VisitaController::class, "destroy"]);

});
