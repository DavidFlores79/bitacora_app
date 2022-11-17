<?php

namespace App\Traits;

use App\Models\Bitacora;
use DateTime;
use Illuminate\Support\Facades\Auth;

trait BitacoraTrait
{
    public function guardarEvento($descripcion, $trace = "", $documento = "S/D", $exitoso = true)
    {
        $dt = new DateTime();
        $bitacora = new Bitacora();
        $bitacora->documento = $documento;
        $bitacora->direccion_ip = $this->getIpAddress();
        $bitacora->nickname_nombre = Auth::user()->name." ".Auth::user()->apellido;
        $bitacora->descripcion = $descripcion;
        $bitacora->trace = "El usuario: ".$bitacora->nickname_nombre." ".$trace." Fecha: ".$dt->format('Y-m-d H:i:s');
        $bitacora->exitoso = $exitoso;
        $bitacora->save();
        return $bitacora;
    }

    public function getIpAddress()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';    
        return $ipaddress; 
    }
}