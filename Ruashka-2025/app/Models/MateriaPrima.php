<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;

    protected $table = 'materia_prima';
    protected $primaryKey = 'Materia_ID';

    protected $fillable = [
        'Materia_Nombre',
        'Materia_Descripcion',
        'Materia_Unidad_Medida',
        'Materia_Stock',
        'Ord_Produc_ID'
    ];

    // Relaciones
    public function ordenProduccion()
    {
        return $this->belongsTo(OrdenProduccion::class, 'Ord_Produc_ID', 'Ord_Produc_ID');
    }
}