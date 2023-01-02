<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    use MenuTrait, BitacoraTrait;

    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.incidencias.index', ['modulosConCategorias' => $modulos]);
    }

    function getInfo()
    {
        $datos = Incidencia::all();
        
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
            'descripcion' => 'required|string|max:255',
            'visita_id' => 'nullable|exists:visitas,id',
        ];
        $this->validate($request, $rules);

        try {
            $dato = new Incidencia();
            $dato->descripcion = $request->input('descripcion');
            if ( $request->input('visita_id') ) $dato->visita_id = $request->input('visita_id');
            $dato->user_id = auth()->user()->id;
            $dato->save();
    
            if(is_object($dato)) {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Creado satisfactoriamente.',
                    'dato' => $dato,
                ];
            }
            $this->guardarEvento("Incidencia", "creó la Incidencia ".$dato->descripcion, $dato->id);
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
            'descripcion' => 'required|string|max:255',
        ];
        $this->validate($request, $rules);
        
        if($request->input('id'))
            $dato = Incidencia::where('id',$request->input('id'))->first();

        try {
            if(is_object($dato)) {
            
                $dato->descripcion = $request->input('descripcion');
                $dato->save();
                
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Editado satisfactoriamente.',
                    'dato' => $dato,
                ];
                $this->guardarEvento("Incidencia", "editó el Incidencia ".$dato->id, $dato->id);
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
        $dato = Incidencia::where('id',$id)->first();

        if(is_object($dato)) {
            $dato->delete();
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Eliminado satisfactoriament.e',
                'dato' => $dato,
            ];
            $this->guardarEvento("Incidencia", "eliminó el Incidencia ".$dato->nombre, $dato->id);
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
