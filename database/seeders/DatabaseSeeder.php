<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@emading.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Create guru user
        User::create([
            'nama' => 'Guru Pembina',
            'username' => 'guru1',
            'email' => 'guru@emading.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru'
        ]);

        // Create siswa user
        User::create([
            'nama' => 'Siswa Test',
            'username' => 'siswa1',
            'email' => 'siswa@emading.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);

        $this->call(KategoriSeeder::class);
    }
}
