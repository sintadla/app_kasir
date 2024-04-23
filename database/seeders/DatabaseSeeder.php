<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'nama' => 'Manajer',
            'username' => 'manajer',
            'password' => bcrypt('password'),
            'role' => 'manajer',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'nama' => 'Kasir',
            'username' => 'kasir',
            'password' => bcrypt('password'),
            'role' => 'kasir',
            'remember_token' => Str::random(10),
        ]);

    }
}
