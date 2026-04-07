<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres'          => $this->faker->firstName(),
            'apellidos'        => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'numero_documento' => $this->faker->unique()->numerify('#############'),
            'telefono'         => $this->faker->numerify('########'),
            'email'            => $this->faker->unique()->safeEmail(),
            'pais_id'          => 1,
            'puntos'           => 0,
            'status_user'      => 1,
            'password'         => Hash::make('password'),
            'accepted_terms'   => true,
        ];
    }
}
