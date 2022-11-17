<?php

namespace App\Traits;

trait MenuTrait
{
    //Obtiene los modulos por perfil
    public function getModulosPerfil()
    {
        $modulos = auth()->user()->perfil->modulos_relacion;
        $modulosDelPerfil = [];
        foreach ($modulos as $j => $modulo) {
            $modulosDelPerfil[$modulo->categorias->nombre][$modulo->nombre] = [
                "id" => $modulo->pivot->modulo_id,
                "nombre" => $modulo->nombre,
                "icono" => $modulo->icono,
                "ruta" => $modulo->ruta,
            ];
        }

        return $modulosDelPerfil;
    }

}
