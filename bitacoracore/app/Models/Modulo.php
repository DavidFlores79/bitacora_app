<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    public function categorias(){
        return $this->belongsTo(CategoriaModulo::class, "categoria_modulo_id");
    }

}
