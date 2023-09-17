<?php

namespace Database\Factories;

use App\Models\StoreHouse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreHouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreHouse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'store_houseable_type' => $this->faker->randomElement([
                \App\Models\ScoutRegiment::class,
                \App\Models\ScoutCommission::class,
                \App\Models\ScoutRegiment::class,
            ]),
            'store_houseable_id' => function (array $item) {
                return app($item['store_houseable_type'])->factory();
            },
        ];
    }
}
