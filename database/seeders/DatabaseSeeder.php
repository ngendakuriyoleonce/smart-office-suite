<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleAndPermissionSeeder::class]);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
        ])->assignRole('Super Admin');

        User::factory()->create([
            'name' => 'CEO User',
            'email' => 'ceo@example.com',
        ])->assignRole('CEO');

        User::factory()->create([
            'name' => 'HR Manager',
            'email' => 'hr@example.com',
        ])->assignRole('HR Manager');

        User::factory()->create([
            'name' => 'Receptionist',
            'email' => 'reception@example.com',
        ])->assignRole('Receptionist');

        User::factory()->create([
            'name' => 'Office Manager',
            'email' => 'office@example.com',
        ])->assignRole('Office Manager');

        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
        ])->assignRole('Employee');
    }
}
