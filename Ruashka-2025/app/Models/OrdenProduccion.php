<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProduccion extends Model
{
    use HasFactory;

    protected $table = 'orden_de_produccion';
    protected $primaryKey = 'Ord_Produc_ID';

    protected $fillable = [
        'Ord_Prod_Fecha_Inicio',
        'Ord_Prod_Fecha_Final',
        'Ord_Prod_Cantidad',
        'Ord_Prod_Estado',
        'Rol_ID',
        'Ord_Prod_Tipo_Producto',
    ];

    protected $casts = [
        'Ord_Prod_Fecha_Inicio' => 'date',
        'Ord_Prod_Fecha_Final' => 'date',
    ];

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'Rol_ID', 'Rol_ID');
    }

    public function materiasPrimas()
    {
        return $this->hasMany(MateriaPrima::class, 'Ord_Produc_ID', 'Ord_Produc_ID');
    }
}