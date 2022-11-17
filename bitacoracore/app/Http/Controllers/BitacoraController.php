<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    use MenuTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.bitacora.index', ['modulosConCategorias' => $modulos]);
    }

    public function consultaBitacora(){
        $bitacoras = Bitacora::orderBy('created_at', 'desc')->get();
        $data = [
            'code' => 200,
            'status' => 'success',
            'bitacoras' => $bitacoras
        ];
        return response()->json($data, $data['code']);
    }

    public function actualizarBitacora()
    {
        $bitacoras = Bitacora::orderBy('created_at', 'desc')->get();
        if (is_object($bitacoras)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'bitacoras' => $bitacoras
            ];
        } else {
            $data = [
                'code' => 404,
                'message' => 'Error al actualizar la Bitacora.',
                'status' => 'error',
            ];
        }
        return response()->json($data, $data['code']);
    }
}
