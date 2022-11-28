<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    use MenuTrait, BitacoraTrait;

    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.perfiles.index', ['modulosConCategorias' => $modulos]);
    }

    function getInfo()
    {
        $datos = Perfil::all();
        
        if(is_object($datos)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'datos' => $datos,
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrió un error al realizar la búsqueda.',
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function create()
    {
        $data = [
            'code' => 200,
            'status' => 'success',
        ];
        return response()->json($data, $data['code']);
    }

    public function store(Request $request) 
    {
        $rules = [
            'nombre' => 'required|string|max:255',
        ];
        $this->validate($request, $rules);

        try {
            $dato = new Perfil();
            $dato->nombre = $request->input('nombre');
            $dato->save();
    
            if(is_object($dato)) {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Creado satisfactoriamente.',
                    'dato' => $dato,
                ];
            }
            return response()->json($data, $data['code']);
        } catch (\Throwable $th) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Se ha producido un error al guardar.'.$th,
            ];
            return response()->json($data, $data['code']);
        }

    }

    public function edit()
    {
        $data = [
            'code' => 200,
            'status' => 'success',
        ];
        return response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
        //return $request;
        //falta validar request
        $rules = [
            'nombre' => 'required|string|max:255',
        ];
        $this->validate($request, $rules);
        
        if($request->input('id'))
            $dato = Perfil::where('id',$request->input('id'))->first();

        try {
            if(is_object($dato)) {
            
                $dato->nombre = $request->input('nombre');
                $dato->save();
                
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Editado satisfactoriamente.',
                    'dato' => $dato,
                ];

                return response()->json($data, $data['code']);
            }
        } catch (\Throwable $th) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Error al actualizar.'.$th,
            ];
            return response()->json($data, $data['code']);
        }
             
    }


    public function destroy($id)
    {
        $dato = Perfil::where('id',$id)->first();

        if(is_object($dato)) {
            $dato->delete();
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Eliminado satisfactoriament.e',
                'dato' => $dato,
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Dato no encontrado.',
            ];
        }
        return response()->json($data, $data['code']);
    }
}
