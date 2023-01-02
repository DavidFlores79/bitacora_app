<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\TipoVehiculo;
use App\Models\User;
use App\Models\Visita;
use App\Traits\BitacoraTrait;
use App\Traits\MenuTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DateTime;

class VisitaController extends Controller
{
    use MenuTrait, BitacoraTrait;

    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view("admin.visitas.index", ["modulosConCategorias" => $modulos]);
    }

    public function show($id) {
        // return $id;
        try {
            $dato = Visita::where("id", $id)->first();

            if (is_object($dato)) {

                $data = [
                    "code" => 200,
                    "status" => "success",
                    "dato" => $dato,
                ];
            } else {
                $data = [
                    "code" => 404,
                    "status" => "error",
                    "message" => "Dato no encontrado.",
                ];
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 404,
                "status" => "error",
                "message" => "Error al buscar el Dato.",
            ];
        }
        
        return response()->json($data, $data["code"]);
    }

    public function registroVisitantes()
    {
        $modulos = $this->getModulosPerfil();
        return view("users.visitas.index", ["modulosConCategorias" => $modulos]);
    }

    public function getVisitas(){
        // $datos = $this->miServicio(User::empleados()->get());
        $visitas = Visita::orderBy("id", "DESC")->servicios()
                            ->select("id",
                                    "app_id",
                                    "servicio_id", 
                                    "nombre_visitante", 
                                    "nombre_quien_visita",
                                    "motivo_visita",
                                    "tipo_vehiculo_id",
                                    "user_id",
                                    "fecha_entrada",
                                    "fecha_salida",
                                    "actualizado",
                                    "created_at",
                                    )->get();
        $tipos_vehiculo = TipoVehiculo::all();

        $data = [
            "code" => 200,
            "status" => "success",
            "datos" => $visitas->load("user", "tipo_vehiculo", "servicio", "incidencias"),
            "servicios" => Servicio::all(),
            "tipos_vehiculo" => $tipos_vehiculo,
            "mis_servicios" => auth()->user()->servicios,
        ];
        return response()->json($data, $data["code"]);

    }

    public function create()
    {
        $data = [
            "code" => 200,
            "status" => "success",
        ];
        return response()->json($data, $data["code"]);
    }

    public function store(Request $request)
    {
        // return $request;   
        $rules = [
            "visitante" => "required|string|min:3|max:255",
            "quien_visita" => "required|string|min:3|max:255",
            "tipo_vehiculo" => "required|numeric|exists:tipo_vehiculos,id",
            "motivo_visita" => "nullable|string|max:255",
        ];

        $this->validate($request, $rules);
        //return $request;
        try {
            $imagen_placas = $request->input("imagen_placas");
            $imagen_identificacion = $request->input("imagen_identificacion");
            $dt = new DateTime();
            $dato = new Visita();
            $dato->nombre_visitante = $request->input("visitante");
            $dato->nombre_quien_visita = $request->input("quien_visita");
            $dato->motivo_visita = $request->input("motivo_visita");
            $dato->tipo_vehiculo_id = $request->input("tipo_vehiculo");
            $dato->servicio_id = $request->input("servicio_id");
            $dato->user_id = auth()->user()->id;
            $dato->placas = $imagen_placas;
            $dato->imagen_identificacion = $imagen_identificacion;
            $dato->actualizado = false;
            $dato->fecha_entrada = $dt->format("Y-m-d H:i:s");
            $dato->save();

            if (is_object($dato)) {
                $data = [
                    "code" => 200,
                    "status" => "success",
                    "message" => "Se ha registrado una visita.",
                    "dato" => $dato->load("servicio", "tipo_vehiculo", "user"),
                ];
            }
            $this->guardarEvento("Registrar Visita", "registró visita"); //bitacora

            return response()->json($data, $data["code"]);
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => "error",
                "message" => "Se ha producido un error al guardar." . $th,
            ];
            $this->guardarEvento("Registrar Visita", "intentó registrar visita", "S/D", false); //bitacora
            return response()->json($data, $data["code"]);
        }
    }

    public function edit()
    {
        $data = [
            "code" => 200,
            "status" => "success",
        ];
        return response()->json($data, $data["code"]);
    }

    public function update(Request $request)
    {
        return $request;
    }


    public function registrarSalida($id)
    {
        try {
            $dato = Visita::where("id", $id)->first();

            if (is_object($dato)) {

                $dt = new DateTime();
                $dato->fecha_salida = $dt->format("Y-m-d H:i:s");
                $dato->save();
                
                $data = [
                    "code" => 200,
                    "status" => "success",
                    "message" => "Salida Registrada satisfactoriamente.",
                    "dato" => $dato,
                ];
                $this->guardarEvento("Registrar Salida", "registró salida de vehículo"); //bitacora

            } else {
                $data = [
                    "code" => 404,
                    "status" => "error",
                    "message" => "Dato no encontrado.",
                ];
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 404,
                "status" => "error",
                "message" => "Dato no encontrado.",
            ];
            $this->guardarEvento("Registrar Salida", "intentó registrar salida de vehículo", "S/D", false); //bitacora
        }
        
        return response()->json($data, $data["code"]);
    }

    public function destroy($id)
    {
        $dato = Visita::where("id", $id)->first();

        if (is_object($dato)) {
            $dato->delete();
            $data = [
                "code" => 200,
                "status" => "success",
                "message" => "Eliminado satisfactoriamente.",
                "dato" => $dato,
            ];
            $this->guardarEvento("Eliminar Registro Vista", "eliminó el registro ".$dato->id." de un vehículo"); //bitacora
        } else {
            $data = [
                "code" => 404,
                "status" => "error",
                "message" => "Dato no encontrado.",
            ];
        }
        return response()->json($data, $data["code"]);
    }

    public function miServicio($usuarios)
    {

        $datos = Collection::make(new Visita);

        if (auth()->user()->perfil_id != 1) {
            foreach ($usuarios as $key => $cadaUsuario) {
                foreach ($cadaUsuario->servicios as $key => $servicio) {
                    for ($i = 0; $i < count(auth()->user()->servicios); $i++) {
                        if (auth()->user()->servicios[$i]["id"] == $servicio->id) {
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
