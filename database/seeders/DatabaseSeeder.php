<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'seller']);
        Role::create(['name' => 'buyer']);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@system.com',

        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Seller User',
            'email' => 'seller@system.com',
        ])->assignRole('seller');

        User::factory()->create([
            'name' => 'Buyer User',
            'email' => 'buyer@system.com',
        ])->assignRole('buyer');
    }
}
