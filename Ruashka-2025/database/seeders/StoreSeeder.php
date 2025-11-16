<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\StorePersonnel;
use App\Models\StoreShift;
use App\Models\StoreMachine;
use App\Models\StoreDocument;
use App\Models\StoreIncident;
use App\Models\StoreRequest;
use App\Models\StoreNotice;
use App\Models\StoreInternalMessage;
use App\Models\StoreAccessLog;
use App\Models\StoreRole;
use App\Models\User;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $store = Store::create([
            'name' => 'Sucursal Principal Ruashka',
            'address' => 'Av. Textil 123, Ciudad de las Telas',
            'phone' => '555-0123',
            'manager_name' => 'Juan Pérez',
            'settings' => ['theme' => 'light', 'notifications' => true],
        ]);

        // Create Roles
        $roles = [];
        $roleNames = ['Gerente de Tienda', 'Asociado de Ventas', 'Personal de Almacén', 'Equipo de Mantenimiento'];
        foreach ($roleNames as $name) {
            $roles[$name] = StoreRole::create([
                'store_id' => $store->id,
                'name' => $name,
                'permissions' => json_encode(['all' => true]), // Simplified permissions
            ]);
        }

        $personnel = [];
        for ($i = 1; $i <= 10; $i++) {
            $personnel[] = StorePersonnel::create([
                'store_id' => $store->id,
                'first_name' => 'Miembro del',
                'last_name' => 'Personal ' . $i,
                'email' => "personal{$i}@ruashka.com",
                'phone' => '555-100' . $i,
                'hire_date' => now()->subMonths(rand(1, 24)),
                'is_active' => true,
            ]);
            
            // Assign random role
            $randomRole = $roles[$roleNames[array_rand($roleNames)]];
            $personnel[count($personnel) - 1]->roles()->attach($randomRole->id);
        }

        StoreShift::create([
            'store_id' => $store->id,
            'name' => 'Turno Mañana',
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
            'days_of_week' => ['Lun', 'Mar', 'Mié', 'Jue', 'Vie'],
        ]);

        $machines = [];
        for ($i = 1; $i <= 5; $i++) {
            $machines[] = StoreMachine::create([
                'store_id' => $store->id,
                'name' => 'Telar ' . $i,
                'serial_number' => 'LM-' . rand(1000, 9999),
                'status' => 'operational',
                'last_maintenance' => now()->subMonths(rand(1, 6)),
                'next_maintenance' => now()->addMonths(rand(1, 6)),
            ]);
        }

        StoreDocument::create([
            'store_id' => $store->id,
            'title' => 'Protocolo de Seguridad',
            'category' => 'protocol',
            'file_path' => 'documents/safety.pdf',
            'description' => 'Procedimientos de seguridad estándar.',
        ]);

        StoreIncident::create([
            'store_id' => $store->id,
            'title' => 'Derrame Menor',
            'description' => 'Derrame de agua cerca del Telar 2.',
            'occurred_at' => now()->subDays(2),
            'severity' => 'low',
            'reported_by' => $personnel[0]->id,
            'status' => 'resolved',
        ]);

        StoreRequest::create([
            'store_id' => $store->id,
            'requester_id' => $personnel[1]->id,
            'type' => 'resupply',
            'details' => 'Necesito más carretes de hilo.',
            'status' => 'pending',
        ]);

        StoreNotice::create([
            'store_id' => $store->id,
            'title' => 'Horario de Festivos',
            'content' => 'La tienda estará cerrada el 25 de diciembre.',
            'created_by' => $personnel[0]->id,
            'expires_at' => now()->addDays(30),
        ]);

        StoreInternalMessage::create([
            'store_id' => $store->id,
            'sender_id' => $personnel[0]->id,
            'recipient_id' => $personnel[1]->id,
            'message' => 'Por favor revise el inventario.',
        ]);

        StoreAccessLog::create([
            'store_id' => $store->id,
            'user_id' => 1, // Assuming user ID 1 exists
            'action' => 'login',
            'details' => 'Usuario inició sesión.',
            'ip_address' => '127.0.0.1',
        ]);
    }
}
