<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function modulos_relacion()
    {
        return $this->belongsToMany(Modulo::class, 'modulo_perfil_permiso')->orderBy('categoria_modulo_id', 'asc')->with('categorias');
    }
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'modulo_perfil_permiso')->withTimestamps()
            ->withPivot('modulo_id');
    }

    public function scopeEmpleados($query)
    {
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->first();
        $perfilSuperUser = Perfil::where("codigo", "superuser")->select("id")->first();
        $perfilCliente = Perfil::where("codigo", "client")->select("id")->first();
        return $query->where('id', '<>', $perfilAdmin->id)->where('id', '<>', $perfilSuperUser->id)->where('id', '<>', $perfilCliente->id);
    }

    public function scopeAdministradores($query)
    {
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->first();
        return $query->where('id', '=', $perfilAdmin->id);
    }

    public function scopeClientes($query)
    {
        $perfilClient = Perfil::where("codigo", "client")->select("id")->first();
        return $query->where('id', '=', $perfilClient->id);
    }
}
