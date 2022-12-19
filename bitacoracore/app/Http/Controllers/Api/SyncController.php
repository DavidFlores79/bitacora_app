<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sync;
use App\Models\Visita;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function syncVisitas(Request $request) {

        $visitas = $request->input('visitas');
        $visitasActualizadas = 0;
        $idsActualizados = [];

        foreach ($visitas as $key => $visita) {

            // if(Visita::where("app_id", $visita['id'])->count() == 0) {
                $registro = new Sync();
                $registro->app_id = $visita['id'];
                $registro->servicio_id = auth()->user()->servicio[0]["id"] ?? 1;
                $registro->nombre_visitante = $visita['nombreVisitante'];
                $registro->nombre_quien_visita = $visita['nombreAQuienVisita'];
                $registro->motivo_visita = $visita['motivoVisita'];
                $registro->imagen_identificacion = $visita['imagenIdentificacion'];
                $registro->tipo_vehiculo_id = $visita['tipoVehiculoId'];
                $registro->placas = $visita['placas'];
                $registro->user_id = $visita['userId'];
                $registro->fecha_entrada = $visita['fechaEntrada'];
                $registro->fecha_salida = new Carbon($visita['fechaSalida']);
                $registro->actualizado = $visita['actualizado'];
                $registro->save();
                $visitasActualizadas++;
                array_push($idsActualizados, $registro->app_id);
            }

        // }

        $data = [
            'code' => 200,
            'status' => 'success',
            'success' => true,
            'message' => "Se han sincronizado ".$visitasActualizadas." registros.",
            'visitas_actualizadas' => $visitasActualizadas,
            'ids_actualizados' => $idsActualizados,
        ];
    
        return response()->json($data, $data['code']);
    }
    
}
