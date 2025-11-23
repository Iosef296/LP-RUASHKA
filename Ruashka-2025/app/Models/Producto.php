<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'sku', 'barcode', 'unit_of_measure', 'price', 'stock_quantity'];

    public function ventaDetalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }

    public function cotizacionDetalles()
    {
        return $this->hasMany(CotizacionDetalle::class);
    }
    //
}
