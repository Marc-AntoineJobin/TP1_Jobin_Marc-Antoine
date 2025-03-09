<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Critic>
 */
class CriticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = Faker::create();
        return [
            "film_id" => $faker->numberBetween(1, 50),
            "score" => $faker->numberBetween(1, 10),
            "comment" => $faker->text(50),
        ];
    }
}
