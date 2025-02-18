<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@plusmove.com',
            'password' => Hash::make('plusmove'),
        ]);
        $admin->assignRole('admin');

        $driver = User::create([
            'name' => 'John Driver',
            'email' => 'driver@plusmove.com',
            'password' => Hash::make('plusmove'),
        ]);
        $driver->assignRole('driver');

        $customer = User::create([
            'name' => 'Jane Customer',
            'email' => 'customer@plusmove.com',
            'password' => Hash::make('plusmove'),
        ]);
        $customer->assignRole('customer');
    }
}
