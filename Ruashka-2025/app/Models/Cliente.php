<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'address', 'document_number'];

    public function ventas()
    {
        return $this->hasMany(VentaCabecera::class);
    }

    public function cotizaciones()
    {
        return $this->hasMany(CotizacionCabecera::class);
    }
}
