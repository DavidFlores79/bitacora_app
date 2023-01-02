<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Scopes\ServicioScope;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'perfil_id',
        'nombre',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function miPerfil()
    {
        return $this->belongsTo(Perfil::class, "perfil_id");
    }

    public function indicencias()
    {
        return $this->belongsTo(Incidencia::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class);
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, "perfil_id")->with('modulos_relacion');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function scopeEmpleados($query)
    {
        $perfilSuperUser = Perfil::where("codigo", "superuser")->select("id")->get();
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->get();
        $perfilClient = Perfil::where("codigo", "client")->select("id")->get();

        foreach ($perfilSuperUser as $key => $value) {
            $query->where('perfil_id', '<>', $value->id);
        }
        foreach ($perfilClient as $key => $value) {
            $query->where('perfil_id', '<>', $value->id);
        }
        foreach ($perfilAdmin as $key => $value) {
            $query->where('perfil_id', '<>', $value->id);
        }
        
        return $query;
    }

    public function scopeAdministradores($query)
    {
        $perfilAdmin = Perfil::where("codigo", "admin")->select("id")->get();

        foreach ($perfilAdmin as $key => $value) {
            $query->orWhere('perfil_id', 'like', $value->id);
        }

        return $query;
    }

    public function scopeClientes($query)
    {
        $perfilClient = Perfil::where("codigo", "client")->select("id")->get();

        foreach ($perfilClient as $key => $value) {
            $query->orWhere('perfil_id', 'like', $value->id);
        }

        return $query;
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope(new ServicioScope);
    // }
}
