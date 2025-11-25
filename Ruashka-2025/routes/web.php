<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// Imports de los controladores del módulo de producción
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProyeccionController;
use App\Http\Controllers\OrdenProduccionController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\CotizacionController;

// Ruta principal (ya existente)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (ya existente)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Settings (ya existentes)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// ========================================
// RUTAS DEL MÓDULO DE GESTIÓN DE PRODUCCIÓN
// ========================================

Route::middleware(['auth'])->group(function () {
    

    // Historia 001: Planificación de producción
    Route::resource('proyecciones', ProyeccionController::class);
    Route::resource('orden_produccion', OrdenProduccionController::class);

    // Rutas para Proveedores (soporte)
    Route::resource('proveedores', ProveedorController::class);

    // Historia 003: Gestión de inventario
    Route::resource('materia_prima', MateriaPrimaController::class);

    // Rutas adicionales para Orden de Producción
Route::post('orden_produccion/cambiar-estado-lote', [OrdenProduccionController::class, 'cambiarEstadoLote'])
    ->name('orden_produccion.cambiar_estado_lote');
Route::get('orden_produccion/exportar-pdf', [OrdenProduccionController::class, 'exportarPDF'])
    ->name('orden_produccion.exportar_pdf');
    
});
// Rutas de Cotizaciones
Route::middleware(['auth'])->group(function () {
    Route::resource('cotizaciones', CotizacionController::class);
    Route::post('cotizaciones/{id}/convertir', [CotizacionController::class, 'convertirAOrden'])
        ->name('cotizaciones.convertir');
});