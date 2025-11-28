<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'nombre',
        'dni',
        'email',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'role_id',
        'sede_id', // Cambiamos 'departamento' por 'sede_id'
        'fecha_ingreso',
        'salario',
        'tipo_contrato',
        'estado',
        'observaciones'
    ];

    // Relación con Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación con Sede
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
