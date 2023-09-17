<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ScoutRegiment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoutRegimentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ScoutRegiment::class;

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
            'scout_commission_id' => \App\Models\ScoutCommission::factory(),
            'scout_regimentable_type' => $this->faker->randomElement([
                \App\Models\StoreHouse::class,
                \App\Models\User::class,
                \App\Models\User::class,
            ]),
            'scout_regimentable_id' => function (array $item) {
                return app($item['scout_regimentable_type'])->factory();
            },
        ];
    }
}
