<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = ['venta_cabecera_id', 'monto', 'metodo_pago'];

    public function venta()
    {
        return $this->belongsTo(VentaCabecera::class, 'venta_cabecera_id');
    }
}
