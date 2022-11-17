<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estatus;
use App\Models\Historial;
use App\Models\Perfil;
use App\Models\Prioridad;
use App\Models\Proyecto;
use App\Models\Servicio;
use App\Models\Ticket;
use App\Models\TicketTipo;
use App\Models\User;
use App\Traits\MenuTrait;
use App\Traits\HistorialTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RequerimientosController extends Controller
{
    use MenuTrait, HistorialTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = $this->getModulosPerfil();
        return view('users.requerimientos.index', ['modulosConCategorias' => $modulos]);
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
        //
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
        //
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
        $ticket = Ticket::findOrFail($request->id);
        $estatusOld = $ticket->estatus_id;

        if ($estatusOld == Config::get("constants.ESTATUS_REGISTRADO")) {
            $ticket->estatus_id = Config::get("constants.ESTATUS_ASIGNADO");
            $ticket->progreso = 10;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_ESTATUS"), Estatus::findOrFail($estatusOld)->descripcion, Estatus::findOrFail($ticket->estatus_id)->descripcion);
        } else {
            if ($ticket->estatus_id != $request->estatus_id) {
                $ticket->estatus_id = $request->estatus_id;
                if ($ticket->estatus_id == Config::get("constants.ESTATUS_ENESPERA") && $estatusOld != Config::get("constants.ESTATUS_ENPROCESO")) {
                    $ticket->progreso = 30;
                }
                if ($ticket->estatus_id == Config::get("constants.ESTATUS_ENPROCESO")) {
                    $ticket->progreso = 60;
                }
                if ($ticket->estatus_id == Config::get("constants.ESTATUS_RESUELTO")) {
                    $ticket->progreso = 100;
                }
                $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_ESTATUS"), Estatus::findOrFail($estatusOld)->descripcion, Estatus::findOrFail($ticket->estatus_id)->descripcion);
            }
        }

        if ($ticket->especialista_id != $request->especialista_id) {
            $userOld = $ticket->especialista_id;
            $ticket->especialista_id = $request->especialista_id;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_ASIGNO"), Config::get("constants.TIPOACCION_RESPONSABLE"), $userOld, $ticket->especialista_id);
        }

        if ($ticket->solucion != $request->solucion) {
            $ticket->solucion = $request->solucion;
        }
        if ($ticket->proyecto_id != $request->proyecto_id) {
            $proyectoOld = $ticket->proyecto_id;
            $ticket->proyecto_id = $request->proyecto_id;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_PROYECTO"), Proyecto::findOrFail($proyectoOld)->nombre, Proyecto::findOrFail($ticket->proyecto_id)->nombre);
        }
        if ($ticket->prioridad_id != $request->prioridad_id) {
            $prioridadOld = $ticket->prioridad_id;
            $ticket->prioridad_id = $request->prioridad_id;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_PRIORIDAD"), Prioridad::findOrFail($prioridadOld)->descripcion, Prioridad::findOrFail($ticket->prioridad_id)->descripcion);
        }
        if ($ticket->ticket_tipo_id != $request->ticket_tipo_id) {
            $tipoOld = $ticket->ticket_tipo_id;
            $ticket->ticket_tipo_id = $request->ticket_tipo_id;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_TIPO"), TicketTipo::findOrFail($tipoOld)->descripcion, TicketTipo::findOrFail($ticket->ticket_tipo_id)->descripcion);
        }

        if ($ticket->servicio_id != $request->servicio_id) {
            $servicioOld = $ticket->servicio_id;
            $ticket->servicio_id = $request->servicio_id;
            $this->saveHistorialTicket($ticket->id, Config::get("constants.ACCION_MODIFICO"), Config::get("constants.TIPOACCION_SERVICIO"), Servicio::findOrFail($servicioOld)->descripcion, Servicio::findOrFail($ticket->servicio_id)->descripcion);
        }

        $ticket->save();

        if (is_object($ticket)) {

            $data = [
                'code' => 200,
                'message' => 'El ticket se ha actualizado correctamente.',
                'status' => 'success',
                'ticket' => $ticket::findOrFail($request->id)->load("proyecto", "prioridad", "tipo", "servicio", "estatus", "seguimiento", "especialista", "creador_ticket", "ticket_historial"),
                'estatus' => Estatus::all(),
            ];
        } else {

            $data = [
                'code' => 400,
                'message' => 'Ticket no actualizado, error desconocido.',
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
        //
    }

    public function getRequerimientos()
    {
        $tickets = Ticket::where([['especialista_id', auth()->user()->id],['ticket_tipo_id', Config::get("constants.TIPOTICKET_REQUERIMIENTO")],['estatus_id', '!=', Config::get("constants.ESTATUS_ELIMINADO")],['estatus_id', '!=', Config::get("constants.ESTATUS_CERRADO")]])->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        $ticketsAll = Ticket::where([['ticket_tipo_id', Config::get("constants.TIPOTICKET_REQUERIMIENTO")],['estatus_id', '!=', Config::get("constants.ESTATUS_ELIMINADO")],['estatus_id', '!=', Config::get("constants.ESTATUS_CERRADO")],['estatus_id', '!=', Config::get("constants.ESTATUS_VENCIDO")]])->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        $ticketsCerrados = Ticket::where([['ticket_tipo_id', Config::get("constants.TIPOTICKET_REQUERIMIENTO")],['estatus_id', Config::get("constants.ESTATUS_CERRADO")]])->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        $ticketsVencidos = Ticket::where([['ticket_tipo_id', Config::get("constants.TIPOTICKET_REQUERIMIENTO")],['estatus_id', Config::get("constants.ESTATUS_VENCIDO")]])->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'tickets' => $tickets,
            'ticketsAll' => $ticketsAll,
            'ticketsCerrados' => $ticketsCerrados,
            'ticketsVencidos' => $ticketsVencidos,
            'proyectos' => Proyecto::all(),
            'ticket_tipos' => TicketTipo::all(),
            'prioridades' => Prioridad::all(),
            'grupos' => Perfil::all(),
            'especialistas' => User::all(),
            'categorias' => Categoria::all(),
            'servicios' => Servicio::all(),
            'estatus' => Estatus::all(),
        ];
        return response()->json($data, $data['code']);
    }

    public function displayTicket()
    {

        $modulos = $this->getModulosPerfil();
        return view('users.displayticket.index', ['modulosConCategorias' => $modulos]);
    }

    public function getTicket($id)
    {

        //$ticket = Ticket::where('especialista_id', auth()->user()->id)->where('ticket_tipo_id',2)->where('estatus_id','!=',Config::get("constants.ESTATUS_ELIMINADO"))->where('estatus_id','!=',Config::get("constants.ESTATUS_CERRADO"))->with("proyecto")->with("prioridad")->with("tipo")->with("servicio")->with("estatus")->with("seguimiento")->with("especialista")->with("ticket_historial")->get();
        $ticket = Ticket::findOrFail($id)->load("proyecto", "prioridad", "tipo", "servicio", "estatus", "seguimiento", "especialista", "creador_ticket", "ticket_historial");

        $data = [
            'code' => 200,
            'status' => 'success',
            'ticket' => $ticket,
            'proyectos' => Proyecto::all(),
            'ticket_tipos' => TicketTipo::all(),
            'prioridades' => Prioridad::all(),
            'grupos' => Perfil::all(),
            'especialistas' => User::all(),
            'categorias' => Categoria::all(),
            'servicios' => Servicio::all(),
            'estatus' => Estatus::all(),
        ];
        return response()->json($data, $data['code']);
    }

}
