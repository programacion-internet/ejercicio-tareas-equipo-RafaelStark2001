<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tarea;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //public function definition(): array
    //{
    //    return [
            //
    //    ];
    //}

    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_limite' => $this->faker->date(),
            'user_id' => User::factory(), // Usuario que creó la tarea
        ];
    }

}
