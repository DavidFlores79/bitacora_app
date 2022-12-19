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
        $perfilSuperUser = Perfil::where("codigo", "superuser")->select("id")->get();
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->get();
        $perfilClient = Perfil::where("codigo", "client")->select("id")->get();

        foreach ($perfilSuperUser as $key => $value) {
            $query->where('id', '<>', $value->id);
        }
        foreach ($perfilClient as $key => $value) {
            $query->where('id', '<>', $value->id);
        }
        foreach ($perfilAdmin as $key => $value) {
            $query->where('id', '<>', $value->id);
        }
        
        return $query;
    }

    public function scopeAdministradores($query)
    {
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->get();

        foreach ($perfilAdmin as $key => $value) {
            $query->orWhere('id', 'like', $value->id);
        }

        return $query;
    }

    public function scopeClientes($query)
    {
        $perfilClient = Perfil::where("codigo", "client")->select("id")->get();

        foreach ($perfilClient as $key => $value) {
            $query->orWhere('id', 'like', $value->id);
        }

        return $query;
    }
}
