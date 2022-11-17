<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    use MenuTrait, BitacoraTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('admin.admin-user.index', ['modulosConCategorias' => $modulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'perfil' => 'required|numeric',
            'telefono' => 'nullable|numeric|digits_between:10,10',
            'email' => 'required|email|unique:users,email',
            'estatus' => 'required',
            'password' => 'required|min:8|max:255',
        ];

        $this->validate($request, $rules);

        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->password = Hash::make($request->password);
        $usuario->perfil_id = $request->perfil;
        $usuario->estatus = $request->estatus;
        $usuario->save();

        if(is_object($usuario)){
            $data = [
                'code' => 200,
                'message' => 'El usuario se ha creado correctamente.',
                'status' => 'success',
                'usuario' => $usuario::findOrFail($usuario->id)->load("miPerfil"),
            ];
            $this->guardarEvento("Crear usuario", "creó al usuario: ".$usuario->email, "S/D");
        } else {
            $data = [
                'code' => 400,
                'message' => 'Usuario no creado, error desconocido.',
                'status' => 'error',
            ];
            // $this->guardarEvento("Crear usuario", "no pudo crear un nuevo usuario", false);

        }
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::where("id",$id)
                ->with("miPerfil")
                ->first();

        if(is_object($usuario)){
            $data = [
                'code' => 200,
                'message' => 'Usuario encontrado.',
                'status' => 'success',
                'usuario' => $usuario,
            ];
        } else {

            $data = [
                'code' => 400,
                'message' => 'Usuario no encontrado.',
                'status' => 'error',
            ];

        }
        return response()->json($data, $data['code']);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $rules = [
            'name' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'perfil' => 'required|numeric',
            'telefono' => 'nullable|numeric|digits_between:10,10',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
            'estatus' => 'required',
        ];

        $this->validate($request, $rules);

        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->perfil_id = $request->perfil;
        $usuario->estatus = $request->estatus;
        $usuario->update();

        if(is_object($usuario)){
            $data = [
                'code' => 200,
                'message' => 'El usuario se ha actualizado correctamente.',
                'status' => 'success',
                'usuario' => $usuario::findOrFail($usuario->id)->load("miPerfil"),
            ];
            $this->guardarEvento("Actualizar usuario", "actualizó al usuario: ".$usuario->email, "S/D");
        } else {

            $data = [
                'code' => 400,
                'message' => 'Usuario no actualizado, error desconocido.',
                'status' => 'error',
            ];

        }
        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if(is_object($usuario)){
            $fecha_baja = new DateTime(); //Fecha actual
            $usuario->estatus = 0;
            $usuario->bloqueado = 1;
            $usuario->fecha_baja = $fecha_baja->format("Y-m-d");
            $usuario->update();
            $data = [
                'code' => 200,
                'message' => 'Usuario eliminado correctamente.',
                'status' => 'success',
                'usuario' => $usuario,
            ];
            $this->guardarEvento("Eliminar usuario", "eliminó al usuario: ".$usuario->email, "S/D");
        } else {

            $data = [
                'code' => 400,
                'message' => 'Usuario no encontrado.',
                'status' => 'error',
            ];

        }
        return response()->json($data, $data['code']);
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:8|max:255',
        ];

        $this->validate($request, $rules);

        $usuario = User::findOrFail($request->id);
        $usuario -> password = Hash::make($request->password);
        $usuario -> update();

        if(is_object($usuario)){

            $data = [
                'code' => 200,
                'message' => 'Contraseña actualizada correctamente.',
                'status' => 'success',
            ];
            $this->guardarEvento("Modificar usuario", "cambió la contraseña al usuario: ".$usuario->email, "S/D");
        } else {

            $data = [
                'code' => 400,
                'message' => 'Contraseña no actualizada, error desconocido.',
                'status' => 'error',
            ];

        }
        return response()->json($data, $data['code']);

    }

    public function getUsers(){
        $usuarios = User::where([
            ["id", "!=", auth()->id()],
            ["estatus",1]
        ])
        ->with("miPerfil")
        ->get();
        $perfiles = Perfil::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'usuarios' => $usuarios,
            'perfiles' => $perfiles,
        ];
        return response()->json($data, $data['code']);

    }
}
