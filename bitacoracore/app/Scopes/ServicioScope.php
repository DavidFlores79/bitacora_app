<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ServicioScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('servicio_id', auth()->user()->servicio_id );
    }
}