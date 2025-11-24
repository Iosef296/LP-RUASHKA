<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionDetalle extends Model
{
    protected $fillable = ['cotizacion_cabecera_id', 'producto_id', 'cantidad', 'especificaciones_tecnicas'];

    public function cabecera()
    {
        return $this->belongsTo(CotizacionCabecera::class, 'cotizacion_cabecera_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
