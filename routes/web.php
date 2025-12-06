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
use App\Livewire\Users\UserIndex;
use App\Livewire\Socio\Dashboard as SocioDashboard;
use App\Livewire\Socio\Profile as SocioProfile;
use App\Livewire\Socio\MyLoans as SocioMyLoans;
use App\Livewire\Socio\MySavings as SocioMySavings;

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
    Route::get('/users', UserIndex::class)->name('users.index')->middleware('permission:users.view');
    Route::get('/roles', RoleIndex::class)->name('roles.index')->middleware('permission:roles.view');
    Route::get('/permisos', PermissionIndex::class)->name('permisos.index')->middleware('permission:permisos.view');
    Route::get('/documentacion', DocumentationIndex::class)->name('documentacion.index');

    // Socio Portal Routes
    Route::middleware('role:Socio')->group(function () {
        Route::get('/socio/dashboard', SocioDashboard::class)->name('socio.dashboard');
        Route::get('/socio/profile', SocioProfile::class)->name('socio.profile');
        Route::get('/socio/my-loans', SocioMyLoans::class)->name('socio.my-loans');
        Route::get('/socio/my-savings', SocioMySavings::class)->name('socio.my-savings');
        Route::get('/socio/my-loans/{loan}/installments', \App\Livewire\Socio\LoanInstallments::class)->name('socio.my-loans.installments');
    });

    Route::redirect('settings', 'settings/profile');

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
