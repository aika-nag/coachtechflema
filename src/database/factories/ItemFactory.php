<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $count = 1;
        return [
            //
            'name' => 'item'. $count++,
            'brand' => $this->faker->company,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(300,40000),
            'condition' => $this->faker->numberBetween(1,4),
            'user_id' => User::factory(),
            'image' => '/dammy'.'.jpg'
        ];
    }
}
