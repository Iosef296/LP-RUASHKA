<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\VentaCabecera;
use App\Models\CotizacionCabecera;
use Carbon\Carbon;

#[Title('Dashboard Ventas')]
class Dashboard extends Component
{
    public function render()
    {
        $totalSalesToday = VentaCabecera::whereDate('fecha_venta', Carbon::today())->sum('total');
        $customersServedToday = VentaCabecera::whereDate('fecha_venta', Carbon::today())->distinct('cliente_id')->count();
        $pendingQuotes = CotizacionCabecera::where('estado', 'Enviada')->count();

        return view('livewire.sales.dashboard', [
            'totalSalesToday' => $totalSalesToday,
            'customersServedToday' => $customersServedToday,
            'pendingQuotes' => $pendingQuotes,
        ]);
    }
}
