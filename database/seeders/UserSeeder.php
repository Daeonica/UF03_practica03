<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Creamos 10 usuarios
    for ($i = 0; $i < 10; $i++) {
        User::create([
            'name' => 'Usuario ' . ($i + 1),
            'email' => 'usuario' . ($i + 1) . '@example.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
}
