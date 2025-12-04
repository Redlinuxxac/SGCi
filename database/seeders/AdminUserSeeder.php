<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el rol de administrador si no existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Crear o encontrar el usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'RosarioEdwinAC@gmail.com'],
            [
                'name' => 'Edwin Rafael Rosario De La Rosa',
                'password' => Hash::make('PPsae5938'),
            ]
        );

        // Asignar el rol de administrador al usuario
        $adminUser->assignRole($adminRole);
    }
}