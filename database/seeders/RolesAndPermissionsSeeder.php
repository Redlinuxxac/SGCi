<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'socio']);

        // create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'RosarioEdwinAC@gmail.com'],
            [
                'name' => 'Edwin Rafael Rosario De La Rosa',
                'password' => Hash::make('PPsae5938')
            ]
        );

        // assign admin role to the admin user
        $adminUser->assignRole($roleAdmin);
    }
}
