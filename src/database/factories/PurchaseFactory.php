<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'item_id' => \App\Models\Item::factory(),
            'address_id' => \App\Models\Address::factory(),
            'subtotal' => $this->faker->numberBetween(100, 10000),
            'payment_method' => 'カード支払い',
        ];
    }
}
