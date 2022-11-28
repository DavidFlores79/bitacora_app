<?php

namespace App\Http\Controllers;

use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    use BitacoraTrait, MenuTrait;
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
        $modulos = $this->getModulosPerfil();
        return view('users.visitas.index', ['modulosConCategorias' => $modulos]);
        // return view('users.visitas.index');
    }
}
