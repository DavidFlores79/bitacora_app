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

    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.visitas.index', ['modulosConCategorias' => $modulos]);
    }

    public function show() {
        return "Hola Mundo!";
    }

    public function registroVisitantes()
    {
        $modulos = $this->getModulosPerfil();
        return view('users.visitas.index', ['modulosConCategorias' => $modulos]);
    }

    public function getVisitas(){
        $visitas = Visita::orderBy('id', 'DESC')->servicio(auth()->user()->servicio_id)->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'datos' => $visitas->load('user', 'tipo_vehiculo', 'servicio'),
        ];
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
        // $rules = [
        //     'nombre' => 'required|string|max:255',
        //     'apellido' => 'nullable|string|max:255',
        //     'perfil' => 'required|numeric|exists:perfils,id',
        //     'telefono' => 'nullable|numeric|digits_between:10,10',
        //     'email' => 'required|email|unique:users,email',
        //     //'estatus' => 'required',
        //     'password' => 'required|min:6|max:255',
        // ];

        // $this->validate($request, $rules);

        // try {
        //     $dato = new User();
        //     $dato->nombre = $request->input('nombre');
        //     $dato->apellido = $request->input('apellido');
        //     $dato->perfil_id = $request->input('perfil');
        //     $dato->email = $request->input('email');
        //     $dato->nickname = $request->input('nickname');
        //     $dato->telefono = $request->input('telefono');
        //     $dato->password = Hash::make($request->input('password'));
        //     $dato->servicio_id = auth()->user()->servicio_id;

        //     $dato->save();

        //     if (is_object($dato)) {
        //         $data = [
        //             'code' => 200,
        //             'status' => 'success',
        //             'message' => 'Creado satisfactoriamente.',
        //             'dato' => $dato->load('miPerfil'),
        //         ];
        //     }
        //     return response()->json($data, $data['code']);
        // } catch (\Throwable $th) {
        //     $data = [
        //         'code' => 400,
        //         'status' => 'error',
        //         'message' => 'Se ha producido un error al guardar.' . $th,
        //     ];
        //     return response()->json($data, $data['code']);
        // }
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
        // $rules = [
        //     'nombre' => 'required|string|max:255',
        // ];
        // $this->validate($request, $rules);

        // if ($request->input('id'))
        //     $dato = User::where('id', $request->input('id'))->first();

        // try {
        //     if (is_object($dato)) {

        //         $dato->nombre = $request->input('nombre');
        //         $dato->apellido = $request->input('apellido');
        //         $dato->perfil_id = $request->input('perfil_id');
        //         $dato->email = $request->input('email');
        //         $dato->nickname = $request->input('nickname');
        //         $dato->telefono = $request->input('telefono');
        //         $dato->password = Hash::make($request->input('password'));
        //         $dato->save();

        //         $data = [
        //             'code' => 200,
        //             'status' => 'success',
        //             'message' => 'Editado satisfactoriamente.',
        //             'dato' => $dato->load('miPerfil'),
        //         ];

        //         return response()->json($data, $data['code']);
        //     }
        // } catch (\Throwable $th) {
        //     $data = [
        //         'code' => 404,
        //         'status' => 'error',
        //         'message' => 'Error al actualizar.' . $th,
        //     ];
        //     return response()->json($data, $data['code']);
        // }
    }


    public function destroy($id)
    {
        $dato = Visita::where('id', $id)->first();

        if (is_object($dato)) {
            $dato->delete();
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Eliminado satisfactoriamente.',
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
