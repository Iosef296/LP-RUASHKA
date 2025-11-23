# Control General Module Implementation

I have implemented the "Control General" module as requested. This module serves as a centralized dashboard for supervising multiple branches (sedes).

## Features Implemented

1.  **Gestión de Sedes**: Displays a grid of branches with their location and organigram link.
2.  **KPIs**: Dashboard of key performance indicators with progress bars.
3.  **Planificación y Estrategia**:
    *   **Planes Estratégicos**: Table showing strategic plans, status, and dates.
    *   **Justificaciones**: List of justifications/logs.
4.  **Gestión de Auditorías y Control**:
    *   **Auditorías**: List of recent audits with results and observations.
    *   **Control de Calidad**: Summary of quality control checks.
5.  **Visión Consolidada de Gastos**: Table of operational expenses by category and branch.

## Technical Details

### Database
Created the following tables:
- `sedes`
- `indicadors`
- `plan_estrategicos`
- `justificacions`
- `auditorias`
- `control_calidads`
- `gasto_operativos`

### Backend
- **Livewire Component**: `App\Livewire\ControlGeneral`
- **Models**: Created models for all the above tables with mass assignment enabled.

### Frontend
- **View**: `resources/views/livewire/control-general.blade.php`
- **Styling**: Used Tailwind CSS for a clean, responsive layout.
- **Navigation**: Added "Control General" link to the sidebar.

## How to Test
1.  Run `php artisan migrate` (already done).
2.  Navigate to `/control-general` or click the link in the sidebar.
3.  Since the database is currently empty, you will see "No hay [item] registrados" messages. You can populate the database using Tinker or a seeder to see the data.
