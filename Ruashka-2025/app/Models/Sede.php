<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'direccion',
        'ciudad',
        'departamento',
        'telefono',
        'email',
        'encargado',
        'capacidad',
        'tipo',
        'estado',
        'observaciones'
    ];
}
