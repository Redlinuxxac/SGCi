<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DepartmentalRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gerente General: a lot of permissions, but not full admin control over roles/permissions
        $gerente = Role::firstOrCreate(['name' => 'Gerente General']);
        $gerente->givePermissionTo([
            'socios.view', 'socios.create', 'socios.edit', 'socios.delete',
            'prestamos.view', 'prestamos.create', 'prestamos.edit', 'prestamos.delete',
            'ahorros.view', 'ahorros.create', 'ahorros.edit', 'ahorros.delete',
            'servicios.view', 'servicios.create', 'servicios.edit', 'servicios.delete',
            'cuentas_contables.view',
            'asientos_contables.view',
            'auditoria.view',
            'users.view', 'users.create', 'users.edit',
        ]);

        // Oficial de Crédito
        $oficialCredito = Role::firstOrCreate(['name' => 'Oficial de Crédito']);
        $oficialCredito->givePermissionTo([
            'socios.view', 'socios.create', 'socios.edit',
            'prestamos.view', 'prestamos.create', 'prestamos.edit',
        ]);

        // Cajero
        $cajero = Role::firstOrCreate(['name' => 'Cajero']);
        $cajero->givePermissionTo([
            'socios.view',
            'ahorros.view', 'ahorros.create', 'ahorros.edit',
            'asientos_contables.create', // for daily cash entries
        ]);

        // Contador
        $contador = Role::firstOrCreate(['name' => 'Contador']);
        $contador->givePermissionTo([
            'cuentas_contables.view', 'cuentas_contables.create', 'cuentas_contables.edit',
            'asientos_contables.view', 'asientos_contables.create',
            'auditoria.view',
        ]);

        // Socio (basic member, can't access the backend)
        $socio = Role::firstOrCreate(['name' => 'Socio']);
        // This role might have permissions for a future client portal, but not for the backend.
    }
}