<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orederNumber' => $this->faker->randomNumber(),
            'from' => $this->faker->randomNumber(),
            'to' => $this->faker->randomNumber(),
        ];
    }
}
