<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function modulos_relacion()
    {
        return $this->belongsToMany(Modulo::class, 'modulo_perfil_permiso')->with('categorias');
    }
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'modulo_perfil_permiso')->withTimestamps()
            ->withPivot('modulo_id');
    }

    public function scopeEmpleados($query)
    {
        return $query->where('id', '<>', 1)->where('id', '<>', 2);
    }

    public function scopeAdministradores($query)
    {
        return $query->where('id', '=', 2);
    }
}
