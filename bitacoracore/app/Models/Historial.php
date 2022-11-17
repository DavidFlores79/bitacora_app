<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial';

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id')->with('miPerfil');
    }
    public function accion()
    {
        return $this->belongsTo(Accion::class, 'accion_id');
    }
    public function accion_tipo()
    {
        return $this->belongsTo(AccionTipo::class, 'accion_tipo_id');
    }
    public function newuser()
    {
        return $this->belongsTo(User::class, 'new_especialista')->with('miPerfil');
    }
    public function olduser()
    {
        return $this->belongsTo(User::class, 'old_especialista')->with('miPerfil');
    }
}
