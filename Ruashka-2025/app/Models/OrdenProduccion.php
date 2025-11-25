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
        'Ord_Prod_Tipo_Producto',
        'Ord_Prod_Cliente',
        'Ord_Prod_Costo_Estimado',
        'Ord_Prod_Estado',
        'Ord_Prod_Prioridad',
        'Ord_Prod_Observaciones',
    ];

    protected $casts = [
        'Ord_Prod_Fecha_Inicio' => 'date',
        'Ord_Prod_Fecha_Final' => 'date',
    ];

    // Relaciones
    public function materiasPrimas()
    {
        return $this->hasMany(MateriaPrima::class, 'Ord_Produc_ID', 'Ord_Produc_ID');
    }

    // Scopes para filtros
    public function scopeEstado($query, $estado)
    {
        if ($estado) {
            return $query->where('Ord_Prod_Estado', $estado);
        }
        return $query;
    }

    public function scopeTipoProducto($query, $tipo)
    {
        if ($tipo) {
            return $query->where('Ord_Prod_Tipo_Producto', $tipo);
        }
        return $query;
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            return $query->where(function($q) use ($buscar) {
                $q->where('Ord_Produc_ID', 'like', "%{$buscar}%")
                  ->orWhere('Ord_Prod_Tipo_Producto', 'like', "%{$buscar}%")
                  ->orWhere('Ord_Prod_Cliente', 'like', "%{$buscar}%");
            });
        }
        return $query;
    }
}