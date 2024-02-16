<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DescriptionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->title() . ' ' . $this->faker->name(),
            'price' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
