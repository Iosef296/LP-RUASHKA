<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
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

    // Sales Module Routes
    Route::get('sales/dashboard', \App\Livewire\Sales\Dashboard::class)->name('sales.dashboard');
    Route::get('sales/pos', \App\Livewire\Sales\POS::class)->name('sales.pos');
    Route::get('sales/quotes', \App\Livewire\Sales\QuotesManagement::class)->name('sales.quotes');
    Route::get('sales/customer-service', \App\Livewire\Sales\CustomerService::class)->name('sales.customer-service');
    Route::get('sales/customer-create', \App\Livewire\Sales\CustomerCreate::class)->name('sales.customer-create');
    Route::get('sales/customers', \App\Livewire\Sales\Customers::class)->name('sales.customers');
});
