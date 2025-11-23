<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'Proveedor_ID';

    protected $fillable = [
        'Proveedor_Nombre',
        'Proveedor_RUC',
        'Proveedor_Rubro',
        'Proveedor_Telefono',
        'Proveedor_Direccion',
        'Materia_ID'
    ];
}