<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Servicio;
use App\Models\User;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use MenuTrait, BitacoraTrait;

    public function indexEmpleado()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.empleados.index', ['modulosConCategorias' => $modulos]);
    }

    public function indexAdmin()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.administradores.index', ['modulosConCategorias' => $modulos]);
    }

    public function indexClient()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.clientes.index', ['modulosConCategorias' => $modulos]);
    }

    function getEmpleados()
    {
        $datos = $this->miServicio(User::empleados()->get());
        $perfiles = Perfil::empleados()->get();
        $servicios = Servicio::all();

        if (is_object($datos)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'datos' => $datos->load('miPerfil', 'servicios'),
                'perfiles' => $perfiles,
                'servicios' => $servicios,
                'mis_servicios' => auth()->user()->servicios,
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

    function getAdmin()
    {
        $datos = $this->miServicio(User::administradores()->get());
        $perfiles = Perfil::administradores()->get();
        $servicios = Servicio::all();

        if (is_object($datos)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'datos' => $datos->load('miPerfil', 'servicios'),
                'perfiles' => $perfiles,
                'servicios' => $servicios,
                'mis_servicios' => auth()->user()->servicios,
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

    function getClientes()
    {
        $datos = User::clientes()->get();
        $perfiles = Perfil::clientes()->get();
        $servicios = Servicio::all();

        if (is_object($datos)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'datos' => $datos->load('miPerfil', 'servicios'),
                'perfiles' => $perfiles,
                'servicios' => $servicios,
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

    function getInfo()
    {
        $datos = User::all();

        if (is_object($datos)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'datos' => $datos->load('miPerfil', 'servicios'),
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
    {   //return $request;
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'perfil' => 'required|numeric|exists:perfils,id',
            'telefono' => 'nullable|numeric|digits_between:10,10',
            'email' => 'required|email|unique:users,email',
            'nickname' => 'required|string|unique:users,nickname',
            'servicios_asig' => 'nullable|array',
            'servicios_asig.*.id' => 'nullable|exists:servicios,id',
            'password' => 'required|min:6|max:255',
        ];

        $this->validate($request, $rules);

        try {
            $dato = new User();
            $dato->nombre = $request->input('nombre');
            $dato->apellido = $request->input('apellido');
            $dato->perfil_id = $request->input('perfil');
            $dato->email = $request->input('email');
            $dato->nickname = $request->input('nickname');
            $dato->telefono = $request->input('telefono');
            $dato->password = Hash::make($request->input('password'));
            $dato->estatus = 1;
            $dato->bloqueado = 0;
            $dato->save();

            $servicios_asig = ($request->servicios_asig == null) ? [] : $request->servicios_asig;
            // if (count($servicios_asig) > 0) {
            if (auth()->user()->perfil_id == 1) {
                for ($i = 0; $i <= count($servicios_asig) - 1; $i++) {
                    $syncData[] = ['servicio_id' => $servicios_asig[$i]['id']];
                }
            } else {
                if (count($servicios_asig) > 0) {
                    for ($i = 0; $i <= count($servicios_asig) - 1; $i++) {
                        $syncData[] = ['servicio_id' => $servicios_asig[$i]['id']];
                    }   
                } else {
                    $syncData[] = ['servicio_id' => auth()->user()->servicios[0]['id']];
                }
            }
            $dato->servicios()->detach();
            $dato->servicios()->sync($syncData);

            if (is_object($dato)) {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Creado satisfactoriamente.',
                    'dato' => $dato->load('miPerfil', 'servicios'),
                ];
            }
            return response()->json($data, $data['code']);
        } catch (\Throwable $th) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Se ha producido un error al guardar.' . $th,
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
        // return $request;
        //falta validar request
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|numeric|digits_between:10,10',
            'perfil_id' => 'required|numeric|exists:perfils,id',
            'servicios_asig_edit' => 'nullable|array',
            'servicios_asig_edit.*.id' => 'nullable|exists:servicios,id',
        ];
        $this->validate($request, $rules);

        if ($request->input('id'))
            $dato = User::where('id', $request->input('id'))->first();

        try {
            if (is_object($dato)) {

                $dato->nombre = $request->input('nombre');
                $dato->apellido = $request->input('apellido');
                $dato->perfil_id = $request->input('perfil_id');
                $dato->email = $request->input('email');
                $dato->nickname = $request->input('nickname');
                $dato->telefono = $request->input('telefono');
                if ($request->input('password')) $dato->password = Hash::make($request->input('password'));
                $dato->save();

                $servicios_asig = ($request->servicios_asig_edit == null) ? [] : $request->servicios_asig_edit;
                // if (count($servicios_asig) > 0) {
                if (auth()->user()->perfil_id == 1) {
                    for ($i = 0; $i <= count($servicios_asig) - 1; $i++) {
                        $syncData[] = ['servicio_id' => $servicios_asig[$i]['id']];
                    }
                } else {
                    if (count($servicios_asig) > 0) {
                        for ($i = 0; $i <= count($servicios_asig) - 1; $i++) {
                            $syncData[] = ['servicio_id' => $servicios_asig[$i]['id']];
                        }   
                    } else {
                        $syncData[] = ['servicio_id' => auth()->user()->servicios[0]['id']];
                    }
                }
                $dato->servicios()->detach();
                $dato->servicios()->sync($syncData);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Editado satisfactoriamente.',
                    'dato' => $dato->load('miPerfil', 'servicios'),
                ];

                return response()->json($data, $data['code']);
            }
        } catch (\Throwable $th) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Error al actualizar.' . $th,
            ];
            return response()->json($data, $data['code']);
        }
    }


    public function destroy($id)
    {
        $dato = User::where('id', $id)->first();

        if (is_object($dato)) {
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

    public function miServicio($usuarios)
    {

        $datos = Collection::make(new User);

        if (auth()->user()->perfil_id != 1) {
            foreach ($usuarios as $key => $cadaUsuario) {
                foreach ($cadaUsuario->servicios as $key => $servicio) {
                    for ($i = 0; $i < count(auth()->user()->servicios); $i++) {
                        if (auth()->user()->servicios[$i]['id'] == $servicio->id) {
                            $datos->add($cadaUsuario);
                        }
                    }
                }
            }
        } else {
            $datos = $usuarios;
        }
        return $datos;
    }
}
