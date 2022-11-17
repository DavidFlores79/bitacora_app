<?php

namespace App\Http\Middleware;

use App\Models\Perfil;
use App\Traits\BitacoraTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

class PermisoRuta
{
    use BitacoraTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!(isset($request->id))) {
            return  redirect('home');
        }

        try {
            $idModulo = Crypt::decrypt($request->id);
        } catch (\Throwable $th) {
            //throw $th;
            return  redirect('home');
        }


        $request->session()->put('modulo_id', $idModulo);
        $modulo_id = session('modulo_id');
        define('VISUALIZAR', 1);
        $permiso = [];
        $perfil = Perfil::findOrFail(auth()->user()->perfil->id);
        foreach ($perfil->permisos as $permisos) {
            $moduloId = $permisos->pivot->modulo_id;
            if ($moduloId == $modulo_id) {
                $permisoId = $permisos->pivot->permiso_id;
                $permiso[] = $permisoId;
            }
        }
        // dd($permiso);
        $mensaje = "No tiene permiso para visualizar <span class='font-weight-bold text-uppercase'>" . $request->path() . " </span>";
        if (in_array(VISUALIZAR, $permiso)) {

            if ((auth()->user()->bloqueado)) {
                $this->guardarEvento("Usuario Bloqueado", " intentó iniciar sesión pero está bloqueado ", "S/D", false);
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $mensaje = "Su usuario está bloqueado. Favor de verificar!";
                return redirect()->route('login')->with("error", $mensaje);
            }
            $this->guardarEvento("Accesar Modulo", "accedió al módulo " . strtoupper($request->path()), "S/D");
            return $next($request);
        }
        $this->guardarEvento("Acceso Modulo", "permiso denegado al módulo " . strtoupper($request->path()), "S/D", false);
        return redirect('home')->withErrors(
            ["permisos" => $mensaje]
        );
    }
}
