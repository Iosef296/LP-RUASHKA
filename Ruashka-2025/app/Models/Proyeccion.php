<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    use HasFactory;

    protected $table = 'proyeccion';
    protected $primaryKey = 'Proyec_ID';

    protected $fillable = [
        'Proyec_Nombre',
        'Proyec_Descripcion',
        'Proyec_tipo'
    ];
}