<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Isaac Ramos',
            'email' => 'ibrhisaanton@gmail.com',
            'password' =>bcrypt('12345678')
        ]);
        Cliente::factory(5)->create();
    }
}
