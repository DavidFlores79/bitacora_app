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

    public function tipo_vehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, "tipo_vehiculo_id");
    }
}
