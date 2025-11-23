<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'Rol_ID';

    protected $fillable = [
        'Rol_Tipo',
        'Rol_Accesos',
        'Trabajador_ID'
    ];

    // Relaciones
    public function ordenesProduccion()
    {
        return $this->hasMany(OrdenProduccion::class, 'Rol_ID', 'Rol_ID');
    }

    public function movimientosInventario()
    {
        return $this->hasMany(MovimientoInventario::class, 'Rol_ID', 'Rol_ID');
    }
}