<?php

use App\Livewire\AddRole;
use App\Livewire\AddSede;
use App\Livewire\Addworker;
use App\Livewire\EditWorker;
use App\Livewire\InventoryList;
use App\Livewire\InverAdd;
use App\Livewire\Roles;
use App\Livewire\Sedes;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\ShowRole;
use App\Livewire\ShowSede;
use App\Livewire\ShowWorker;
use App\Livewire\Worker;
use Illuminate\Queue\Events\WorkerStarting;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
        Route::get('/workers', Worker::class)->name('worker.index');
        Route::get('/workers/create', Addworker::class)->name('worker.create');
        Route::get('/workers/{id}/edit', EditWorker::class)->name('worker.edit');
        Route::get('/workers/{id}', ShowWorker::class)->name('worker.show');
        Route::delete('/workers/{id}', [Worker::class, 'destroy'])->name('worker.destroy');
        Route::get('/sedes', Sedes::class)->name('sede.index');
        Route::get('/sedes/create', AddSede::class)->name('sede.create');
        Route::get('/sedes/{id}', ShowSede::class)->name('sede.show');
        Route::get('/roles', Roles::class)->name('role.index');
        Route::get('/roles/create', AddRole::class)->name('role.create');
        Route::get('/roles/{id}', ShowRole::class)->name('role.show');
        Route::get('sales/dashboard', \App\Livewire\Sales\Dashboard::class)->name('sales.dashboard');
        Route::get('sales/pos', \App\Livewire\Sales\POS::class)->name('sales.pos');
        Route::get('sales/quotes', \App\Livewire\Sales\QuotesManagement::class)->name('sales.quotes');
        Route::get('sales/customer-service', \App\Livewire\Sales\CustomerService::class)->name('sales.customer-service');
        Route::get('sales/customer-create', \App\Livewire\Sales\CustomerCreate::class)->name('sales.customer-create');
        Route::get('sales/customers', \App\Livewire\Sales\Customers::class)->name('sales.customers');
        route::get('inveradd',InverAdd::class)->name('inveradd');
        route::get('inventorylist',InventoryList::class)->name('inventorylist');

        });

        Route::middleware(['auth', 'verified'])->prefix('store')->name('store.')->group(function () {
        Route::get('dashboard', \App\Livewire\Store\Dashboard::class)->name('dashboard');
        Route::get('summary', \App\Livewire\Store\Summary::class)->name('summary');
        Route::get('personnel', \App\Livewire\Store\Personnel::class)->name('personnel');
        Route::get('attendance', \App\Livewire\Store\Attendance::class)->name('attendance');
        Route::get('maintenance', \App\Livewire\Store\Maintenance::class)->name('maintenance');
        Route::get('documents', \App\Livewire\Store\Documents::class)->name('documents');
        Route::get('incidents', \App\Livewire\Store\Incidents::class)->name('incidents');
        Route::get('requests', \App\Livewire\Store\Requests::class)->name('requests');
        Route::get('access-logs', \App\Livewire\Store\AccessLogs::class)->name('access-logs');
        Route::get('communications', \App\Livewire\Store\Communications::class)->name('communications');
        Route::get('settings', \App\Livewire\Store\Settings::class)->name('settings');
    });
