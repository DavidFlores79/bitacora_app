<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Historial;
use App\Models\Perfil;
use App\Models\Prioridad;
use App\Models\Proyecto;
use App\Models\Servicio;
use App\Models\Ticket;
use App\Models\TicketTipo;
use App\Models\User;
use App\Traits\MenuTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class GestionTicketsController extends Controller
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
        return view('users.gestiontickets.index', ['modulosConCategorias' => $modulos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'code' => 200,
            'status' => 'success',
        ];
        return response()->json($data, $data['code']);
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
            'proyecto' => 'required|numeric',
            'prioridad' => 'required|numeric',
            'tipo' => 'required|numeric',
            'servicio' => 'required|numeric',
            'asunto' => 'required|string|max:25',
            'descripcion' => 'required|string',
            'email' => 'required|email',
            'tel' => 'required|numeric|digits_between:10,10',
        ];

        $this->validate($request, $rules);

        $datos = new Ticket();
        $datos->user_id = auth()->user()->id;
        $datos->proyecto_id = $request->proyecto;
        $datos->ticket_tipo_id = $request->tipo;
        $datos->prioridad_id = $request->prioridad;
        $datos->servicio_id = $request->servicio;
        $datos->estatus_id = Config::get("constants.ESTATUS_REGISTRADO");
        $datos->seguimiento_id = 1;
        $datos->especialista_id = $request->especialista;
        $datos->titulo = $request->asunto;
        $datos->descripcion = $request->descripcion;
        $datos->email = $request->email;
        $datos->telefono = $request->tel;
        $datos->archivos = $request->archivo;
        $datos->progreso = 0;
        $datos->save();

        $historial = new Historial();
        $historial->ticket_id = $datos->id;
        $historial->responsable_id = auth()->user()->id;
        $historial->accion_id = 1;
        $historial->accion_tipo_id = 1;
        $historial->save();

        $tickets = Ticket::where('user_id', auth()->user()->id)->where('estatus_id','!=',Config::get("constants.ESTATUS_ELIMINADO"))->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        if (is_object($datos)) {

            $data = [
                'code' => 200,
                'message' => 'El ticket se ha guardado correctamente.',
                'status' => 'success',
                'tickets' => $tickets,
            ];
        } else {

            $data = [
                'code' => 400,
                'title' => 'Hubo un problema',
                'message' => 'Ticket no creado, error desconocido.',
                'status' => 'error',
            ];

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

        $ticket = Ticket::where('id', $id)->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();

        if (is_object($ticket)) {

            $data = [
                'code' => 201,
                'message' => 'Los datos se han encontrado satisfactoriamente.',
                'status' => 'success',
                'ticket' => $ticket,
            ];
        } else {
            $data = [
                'code' => 404,
                'message' => 'El ticket no existe.',
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existe = Ticket::findOrFail($id);

        if (is_object($existe)) {

            //Ticket::destroy($id);
            $existe->estatus_id = Config::get("constants.ESTATUS_ELIMINADO");
            $existe->save();

            $tickets = Ticket::where('user_id', auth()->user()->id)->where('estatus_id','!=',Config::get("constants.ESTATUS_ELIMINADO"))->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();

            $data = [
                'code' => 200,
                'message' => 'Se ha eliminado correctamente.',
                'status' => 'success',
                'tickets' => $tickets,
                'name' => $existe->id,
            ];
        } else {
            $data = [
                'code' => 404,
                'message' => 'El ticket no existe.',
                'status' => 'error',
            ];
        }

        return response()->json($data);
    }

    public function getTickets()
    {

        $tickets = Ticket::where('user_id', auth()->user()->id)->where('estatus_id','!=',Config::get("constants.ESTATUS_ELIMINADO"))->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        $proyectos = Proyecto::all();
        $ticket_tipos = TicketTipo::all();
        $prioridades = Prioridad::all();
        $grupos = Perfil::all();
        $especialistas = User::all();
        $categorias = Categoria::all();
        $servicios = Servicio::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'tickets' => $tickets,
            'proyectos' => $proyectos,
            'ticket_tipos' => $ticket_tipos,
            'prioridades' => $prioridades,
            'grupos' => $grupos,
            'especialistas' => $especialistas,
            'categorias' => $categorias,
            'servicios' => $servicios,
        ];

        return response()->json($data, $data['code']);
    }
}
