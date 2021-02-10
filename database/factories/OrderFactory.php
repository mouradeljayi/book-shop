<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'book_title' => $this->faker->sentence(),
            'qty' => $this->faker->numberBetween($min = 1, $max = 10),
            'price' => $this->faker->numberBetween($min = 100, $max = 900),
            'total' => $this->faker->numberBetween($min = 100, $max = 900),
        ];
    }
}
