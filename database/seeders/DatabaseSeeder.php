<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();

            User::factory()->create([
                'name' => 'mang ondi',
                'email' => 'ondi@idn.com',
                // hash buat jadi random
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'phone' => '08123456789',
            ]);
    }
}
