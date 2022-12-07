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

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, "servicio_id");
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
        return $query->where('perfil_id', '<>', 1)->where('perfil_id', '<>', 2);
    }

    public function scopeAdministradores($query)
    {
        return $query->where('perfil_id', '=', 2);
    }

    public function scopeServicio($query, $servicio_id)
    {
        return (auth()->user()->perfil_id != 1) ?  $query->where('servicio_id', $servicio_id) : $query;
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope(new ServicioScope);
    // }
}
