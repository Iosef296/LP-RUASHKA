<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionCabecera extends Model
{
    protected $fillable = ['cliente_id', 'fecha_vencimiento', 'total_estimado', 'estado'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalles()
    {
        return $this->hasMany(CotizacionDetalle::class);
    }
}
