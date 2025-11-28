<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'nivel',
        'permisos',
        'usuarios_count',
        'departamento',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'permisos' => 'array',
    ];
}
