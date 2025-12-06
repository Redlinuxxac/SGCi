<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str; // Add this line

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $modules = [
            'socios',
            'prestamos',
            'ahorros',
            'servicios',
            'cuentas_contables',
            'asientos_contables',
            'roles',
            'permisos',
            'auditoria',
            'users',
            'socio.dashboard',
            'socio.profile',
            'socio.loans',
            'socio.savings',
        ];

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                // For socio.dashboard, socio.profile, socio.loans, socio.savings, only create 'view' and 'edit' as relevant
                if (Str::startsWith($module, 'socio.') && !in_array($action, ['create', 'delete']) || !Str::startsWith($module, 'socio.')) {
                     Permission::firstOrCreate(['name' => $module . '.' . $action]);
                }
            }
        }
        
        // Custom permissions for socio portal
        Permission::firstOrCreate(['name' => 'socio.dashboard.view']);
        Permission::firstOrCreate(['name' => 'socio.profile.view']);
        Permission::firstOrCreate(['name' => 'socio.profile.edit']);
        Permission::firstOrCreate(['name' => 'socio.loans.view']);
        Permission::firstOrCreate(['name' => 'socio.savings.view']);

        // Give admin all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}