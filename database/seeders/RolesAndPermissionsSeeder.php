<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $driver = Role::create(['name' => 'driver']);
        $customer = Role::create(['name' => 'customer']);

        // Create permissions
        Permission::create(['name' => 'manage deliveries']);
        Permission::create(['name' => 'assign deliveries']);
        Permission::create(['name' => 'track deliveries']);
        Permission::create(['name' => 'mark delivered']);
        Permission::create(['name' => 'mark returned']);

        // Assign permissions
        $admin->givePermissionTo(['manage deliveries', 'assign deliveries', 'track deliveries']);
        $driver->givePermissionTo(['track deliveries', 'mark delivered', 'mark returned']);
        $customer->givePermissionTo(['track deliveries']);
    }
}
