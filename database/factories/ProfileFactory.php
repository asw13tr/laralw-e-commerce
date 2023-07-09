<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $genderList = ['male', 'female'];
        $genderIndex = array_rand( $genderList);
        return [
            'user_id' => fake()->numberBetween(1, 20000),
            'firstname' => fake()->firstName( $genderList[$genderIndex] ),
            'lastname' => fake()->lastName(),
            'gender' =>  $genderList[$genderIndex],
            'birthdate' => fake()->date('Y-m-d'),
            'phone' => fake()->phoneNumber(),
            'avatar' => fake()->imageUrl(),

        ];
    }
}
