<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VentaCabecera; // Added for relationship
use App\Models\Producto; // Added for relationship

class VentaDetalle extends Model
{
    protected $fillable = ['venta_cabecera_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];

    public function cabecera()
    {
        return $this->belongsTo(VentaCabecera::class, 'venta_cabecera_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
