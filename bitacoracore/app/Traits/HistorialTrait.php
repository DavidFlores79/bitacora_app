<?php

namespace App\Traits;

use App\Models\Historial;
use Illuminate\Support\Facades\Auth;

trait HistorialTrait
{
    public function saveHistorialTicket($id, $accion, $tipo, $old, $new)
    {

        if ($accion == 2) {
            $historial = new Historial();
            $historial->ticket_id = $id;
            $historial->responsable_id = auth()->user()->id;
            $historial->accion_id = $accion;
            $historial->accion_tipo_id = $tipo;
            $historial->old_especialista = $old;
            $historial->new_especialista = $new;
            $historial->save();

        } else {
            $historial = new Historial();
            $historial->ticket_id = $id;
            $historial->responsable_id = auth()->user()->id;
            $historial->accion_id = $accion;
            $historial->accion_tipo_id = $tipo;
            $historial->old = $old;
            $historial->new = $new;
            $historial->save();
        }
    }

}
