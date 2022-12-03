<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $modulos = auth()->user()->perfil->modulos_relacion;
        $modulosDelPerfil = [];
        foreach ($modulos as $j => $modulo) {
            $modulosDelPerfil[$modulo->categorias->nombre][$modulo->nombre] =  [
                "id" => $modulo->pivot->modulo_id,
                "nombre" => $modulo->nombre,
                "icono" => $modulo->icono,
                "ruta" => $modulo->ruta
            ];
        }
        $modulos = $modulosDelPerfil;
        return view('home', ['modulosConCategorias' => $modulos]);
    }

    public function getProfileCode() {
        return auth()->user()->miPerfil->codigo;
    }


}
