<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ProfileFactory extends Factory
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
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'zipcode' => $this->faker->numerify('###-####'),
            'address' => $this->faker->prefecture(),
            'building' => $this->faker->secondaryAddress(),
            'image' => '/dammy'. $count++. '.jpg'
        ];
    }
}
