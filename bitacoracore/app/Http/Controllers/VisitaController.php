<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visita;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    use MenuTrait, BitacoraTrait;

    public function index(User $model)
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.visitas.index', ['modulosConCategorias' => $modulos]);
    }

    public function getVisitas(){
        $visitas = Visita::orderBy('id', 'DESC')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'datos' => $visitas->load('user', 'servicio'),
        ];
        return response()->json($data, $data['code']);

    }
    
}
