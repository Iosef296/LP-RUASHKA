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
