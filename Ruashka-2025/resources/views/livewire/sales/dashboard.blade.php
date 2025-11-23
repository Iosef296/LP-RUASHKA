<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard de Ventas - Sede Principal</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- KPI Cards -->
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h2 class="text-gray-500 text-sm font-semibold uppercase">Ventas de Hoy</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">${{ number_format($totalSalesToday, 2) }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
            <h2 class="text-gray-500 text-sm font-semibold uppercase">Clientes Atendidos</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $customersServedToday }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <h2 class="text-gray-500 text-sm font-semibold uppercase">Cotizaciones Pendientes</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingQuotes }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <a href="{{ route('sales.pos') }}" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-8 rounded-lg shadow-lg transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="text-2xl font-bold">Iniciar Nueva Venta</span>
        </a>

        <a href="{{ route('sales.quotes') }}" class="block bg-purple-600 hover:bg-purple-700 text-white text-center py-8 rounded-lg shadow-lg transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-2xl font-bold">Crear Nueva Cotización</span>
        </a>

        <a href="{{ route('sales.customer-create') }}" class="block bg-green-600 hover:bg-green-700 text-white text-center py-8 rounded-lg shadow-lg transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            <span class="text-2xl font-bold">Registrar Cliente</span>
        </a>
    </div>
</div>
