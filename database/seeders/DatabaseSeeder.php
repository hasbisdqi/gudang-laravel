<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        $petugas = User::create([
            'name' => 'Petugas Gudang',
            'email' => 'petugas@example.com',
            'password' => bcrypt('password'),
        ]);
        $sarpras = User::create([
            'name' => 'Sarpras',
            'email' => 'sarpras@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(ShieldSeeder::class);
        $superadmin->assignRole('super_admin');
        $petugas->assignRole('petugas');
        $sarpras->assignRole('sarpras');
        $admin->assignRole('admin');
    }
}
