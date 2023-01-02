<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $table = 'visitas';

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, "servicio_id");
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }

    public function tipo_vehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, "tipo_vehiculo_id");
    }

    public function scopeServicios($query)
    {
        $servicios = auth()->user()->servicios;

        foreach ($servicios as $key => $servicio) {
            $query->orWhere('servicio_id', '=', $servicio->id);
        }

        return $query;
    }
}
