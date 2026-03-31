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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        User::factory()->create([
            'name' => 'Petugas Gudang',
            'email' => 'petugas@example.com',
        ]);
        User::factory()->create([
            'name' => 'Sarpras',
            'email' => 'sarpras@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin biasa ajah aowkaok',
            'email' => 'admin@example.com',
        ]);
    }
}
