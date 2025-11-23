<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indicador;
use Carbon\Carbon;

class IndicadorSeeder extends Seeder
{
    public function run(): void
    {
        $indicadores = [
            [
                'ind_tipo' => '1',
                'ind_descripcion' => 'Eficiencia de producción mensual',
                'ind_metas' => '85%',
                'ind_valor_actual' => '82%',
                'ind_porcentaje_cumpl' => '96.47%',
                'ind_fecha_actua' => Carbon::now(),
                'rol_id' => 1
            ],
            [
                'ind_tipo' => '2',
                'ind_descripcion' => 'Ventas mensuales objetivo',
                'ind_metas' => '500000',
                'ind_valor_actual' => '480000',
                'ind_porcentaje_cumpl' => '96%',
                'ind_fecha_actua' => Carbon::now(),
                'rol_id' => 1
            ],
            [
                'ind_tipo' => '3',
                'ind_descripcion' => 'Stock mínimo de seguridad',
                'ind_metas' => '1000 unidades',
                'ind_valor_actual' => '1200 unidades',
                'ind_porcentaje_cumpl' => '120%',
                'ind_fecha_actua' => Carbon::now(),
                'rol_id' => 2
            ]
        ];

        foreach ($indicadores as $indicador) {
            Indicador::create($indicador);
        }
    }
}