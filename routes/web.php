<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\SocioManager;
use App\Livewire\PrestamoManager;
use App\Livewire\AhorroManager;
use App\Livewire\PlanCuentasManager;
use App\Livewire\AsientosManager;
use App\Livewire\Socios\SocioIndex;
use App\Livewire\Prestamos\PrestamoIndex;
use App\Livewire\Ahorros\AhorroIndex;
use App\Livewire\Servicios\ServicioIndex;
use App\Livewire\Contabilidad\PlanCuentasIndex;
use App\Livewire\Contabilidad\AsientoIndex;
use App\Livewire\Auditoria\AuditoriaIndex;
use App\Livewire\Seguridad\RoleIndex;
use App\Livewire\Seguridad\PermissionIndex;
use App\Livewire\Documentation\Index as DocumentationIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/socios', SocioIndex::class)->name('socios.index')->middleware('permission:socios.view');
    Route::get('/prestamos', PrestamoIndex::class)->name('prestamos.index')->middleware('permission:prestamos.view');
    Route::get('/ahorros', AhorroIndex::class)->name('ahorros.index')->middleware('permission:ahorros.view');
    Route::get('/servicios', ServicioIndex::class)->name('servicios.index')->middleware('permission:servicios.view');
    Route::get('/plan-cuentas', PlanCuentasIndex::class)->name('plan-cuentas.index')->middleware('permission:cuentas_contables.view');
    Route::get('/asientos-contables', AsientoIndex::class)->name('asientos.index')->middleware('permission:asientos_contables.view');
    Route::get('/auditoria', AuditoriaIndex::class)->name('auditoria.index')->middleware('permission:auditoria.view');
    Route::get('/roles', RoleIndex::class)->name('roles.index')->middleware('permission:roles.view');
    Route::get('/permisos', PermissionIndex::class)->name('permisos.index');
    Route::get('/documentacion', DocumentationIndex::class)->name('documentacion.index');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
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
