<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function ticket_historial()
    {
        return $this->hasmany(Historial::class, 'ticket_id')->orderBy('created_at', 'desc')->with("responsable")->with("accion")->with("accion_tipo")->with("olduser")->with("newuser");
    }
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad_id');
    }
    public function tipo()
    {
        return $this->belongsTo(TicketTipo::class, 'ticket_tipo_id');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id')->with('categoria');
    }
    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }
    public function seguimiento()
    {
        return $this->belongsTo(Seguimiento::class, 'seguimiento_id');
    }
    public function especialista()
    {
        return $this->belongsTo(User::class, 'especialista_id')->with('miPerfil');
    }
    public function creador_ticket()
    {
        return $this->belongsTo(User::class, 'user_id')->with('miPerfil');
    }
}
