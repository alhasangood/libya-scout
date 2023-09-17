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
            'phone_number' => $this->faker->randomNumber(),
            'scout_commissionable_type' => $this->faker->randomElement([
                \App\Models\StoreHouse::class,
                \App\Models\ScoutCommission::class,
            ]),
            'scout_commissionable_id' => function (array $item) {
                return app($item['scout_commissionable_type'])->factory();
            },
        ];
    }
}
