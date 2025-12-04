<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CuentaContable;

class CuentasContablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nivel 1
        $activos = CuentaContable::firstOrCreate(
            ['codigo' => '1'],
            ['nombre' => 'Activos', 'tipo' => 'activo', 'permite_transacciones' => false]
        );

        // Nivel 2
        $activosCorrientes = CuentaContable::firstOrCreate(
            ['codigo' => '1.1'],
            ['nombre' => 'Activos Corrientes', 'tipo' => 'activo', 'padre_id' => $activos->id, 'permite_transacciones' => false]
        );

        // Nivel 3 (Transaccionales)
        CuentaContable::firstOrCreate(
            ['codigo' => '1.1.01'],
            ['nombre' => 'Bancos', 'tipo' => 'activo', 'padre_id' => $activosCorrientes->id, 'permite_transacciones' => true]
        );

        CuentaContable::firstOrCreate(
            ['codigo' => '1.1.02'],
            ['nombre' => 'Préstamos por Cobrar', 'tipo' => 'activo', 'padre_id' => $activosCorrientes->id, 'permite_transacciones' => true]
        );
    }
}
