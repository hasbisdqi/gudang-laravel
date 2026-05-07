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

        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $petugas = User::factory()->create([
            'name' => 'Petugas Gudang',
            'email' => 'petugas@example.com',
        ]);
        $sarpras = User::factory()->create([
            'name' => 'Sarpras',
            'email' => 'sarpras@example.com',
        ]);
        $admin = User::factory()->create([
            'name' => 'Admin biasa ajah aowkaok',
            'email' => 'admin@example.com',
        ]);

        $this->call(ShieldSeeder::class);
        $superadmin->assignRole('super_admin');
        $petugas->assignRole('petugas');
        $sarpras->assignRole('sarpras');
        $admin->assignRole('admin');
    }
}
