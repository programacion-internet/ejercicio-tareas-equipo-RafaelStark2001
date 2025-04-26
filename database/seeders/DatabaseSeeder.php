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

        // Usuario 1: Rafael Castillo
        User::firstOrCreate(
            ['email' => 'rafaelcastillostark2001@gmail.com'],
            [
                'name' => 'Rafael Castillo',
                'email_verified_at' => now(),
                'password' => Hash::make('Rafaelcastillo01#'),
            ]
        );

        // Usuario 2: Paloma Beltran
        User::firstOrCreate(
            ['email' => 'palomabeltran@gmail.com'],
            [
                'name' => 'Paloma Beltran',
                'email_verified_at' => now(),
                'password' => Hash::make('Paloma1234#'),
            ]
        );

        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        // Ejecutar el TareaSeeder
        $this->call([
            TareaSeeder::class,
        ]);
    }
}
