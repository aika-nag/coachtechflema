<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seller = User::factory()->create();
        $buyer = User::factory()->create();
        $item =Item::factory()->create([
                'user_id' => $seller->id
            ]);

        return [
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'item_id' => $item->id,
            'payment' => $this->faker->numberBetween(1,2),
            'delivery_zipcode' => $this->faker->numerify('###-####'),
            'delivery_address' => $this->faker->prefecture(),
            'delivery_building' => $this->faker->secondaryAddress()
        ];
    }
}
