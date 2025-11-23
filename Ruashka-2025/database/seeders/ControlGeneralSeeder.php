<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sede;
use App\Models\Indicador;
use App\Models\PlanEstrategico;
use App\Models\Justificacion;
use App\Models\Auditoria;
use App\Models\ControlCalidad;
use App\Models\GastoOperativo;
use Carbon\Carbon;

class ControlGeneralSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sedes
        $sede1 = Sede::create([
            'ubicacion' => 'Av. Principal 123, Lima',
            'organigrama' => 'https://example.com/org-lima.pdf',
        ]);
        
        $sede2 = Sede::create([
            'ubicacion' => 'Jr. Comercio 456, Gamarra',
            'organigrama' => 'https://example.com/org-gamarra.pdf',
        ]);

        $sede3 = Sede::create([
            'ubicacion' => 'Calle Industrial 789, Arequipa',
            'organigrama' => null,
        ]);

        // 2. Indicadores (KPIs)
        Indicador::create([
            'tipo' => 'Financiero',
            'descripcion' => 'Margen de Ganancia Global',
            'metas' => '25%',
            'valor_actual' => '22%',
            'porcentaje_cumplimiento' => 88.00,
            'fecha_actual' => Carbon::now(),
            'sede_id' => null, // Global
        ]);

        Indicador::create([
            'tipo' => 'Operativo',
            'descripcion' => 'Eficiencia de Producción - Lima',
            'metas' => '95%',
            'valor_actual' => '92%',
            'porcentaje_cumplimiento' => 96.84,
            'fecha_actual' => Carbon::now(),
            'sede_id' => $sede1->id,
        ]);

        Indicador::create([
            'tipo' => 'Ventas',
            'descripcion' => 'Cumplimiento de Ventas - Gamarra',
            'metas' => 'S/ 100,000',
            'valor_actual' => 'S/ 85,000',
            'porcentaje_cumplimiento' => 85.00,
            'fecha_actual' => Carbon::now(),
            'sede_id' => $sede2->id,
        ]);

        // 3. Planes Estratégicos
        $plan1 = PlanEstrategico::create([
            'nombre' => 'Expansión 2025',
            'objetivos' => 'Abrir 2 nuevas tiendas en el norte del país y aumentar la capacidad productiva en un 30%.',
            'fecha_inicio' => Carbon::now()->startOfYear(),
            'fecha_final' => Carbon::now()->endOfYear(),
            'estado' => 'En Progreso',
        ]);

        $plan2 = PlanEstrategico::create([
            'nombre' => 'Digitalización Total',
            'objetivos' => 'Implementar sistema ERP integrado en todas las sedes y lanzar e-commerce.',
            'fecha_inicio' => Carbon::now()->subMonths(6),
            'fecha_final' => Carbon::now()->addMonths(6),
            'estado' => 'En Progreso',
        ]);

        // Justificaciones
        Justificacion::create([
            'asunto' => 'Retraso en apertura Piura',
            'descripcion' => 'Demoras en los permisos municipales han retrasado la obra civil por 2 semanas.',
            'plan_estrategico_id' => $plan1->id,
        ]);

        Justificacion::create([
            'asunto' => 'Compra de servidores',
            'descripcion' => 'Se requiere presupuesto adicional para servidores dedicados para el ERP.',
            'plan_estrategico_id' => $plan2->id,
        ]);

        // 4. Auditorías
        Auditoria::create([
            'fecha' => Carbon::now()->subDays(15),
            'area' => 'Inventario',
            'resultado' => 'Con Observaciones',
            'observaciones' => 'Diferencias menores en el conteo de hilos.',
            'sede_id' => $sede1->id,
        ]);

        Auditoria::create([
            'fecha' => Carbon::now()->subDays(5),
            'area' => 'Caja',
            'resultado' => 'Conforme',
            'observaciones' => 'Cuadre de caja correcto.',
            'sede_id' => $sede2->id,
        ]);

        // Control de Calidad
        ControlCalidad::create([
            'fecha_control' => Carbon::now()->subDays(2),
            'resultado' => 'Aprobado',
            'sede_id' => $sede1->id,
        ]);

        ControlCalidad::create([
            'fecha_control' => Carbon::now()->subDays(1),
            'resultado' => 'Rechazado', // Lote defectuoso
            'sede_id' => $sede3->id,
        ]);

        // 5. Gastos Operativos
        GastoOperativo::create([
            'categoria' => 'Servicios Básicos',
            'desembolso' => 1500.50,
            'sede_id' => $sede1->id,
        ]);

        GastoOperativo::create([
            'categoria' => 'Mantenimiento',
            'desembolso' => 850.00,
            'sede_id' => $sede2->id,
        ]);

        GastoOperativo::create([
            'categoria' => 'Marketing Global',
            'desembolso' => 5000.00,
            'sede_id' => null,
        ]);
    }
}
