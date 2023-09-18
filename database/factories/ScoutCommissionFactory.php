<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ScoutCommission;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoutCommissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ScoutCommission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            // 'store_house_id' => \App\Models\StoreHouse::factory(),
            // 'order_id' => \App\Models\Order::factory(),
            // 'user_id' => \App\Models\User::factory(),
            // 'scout_regiment_id' => \App\Models\ScoutRegiment::factory(),
        ];
    }
}
