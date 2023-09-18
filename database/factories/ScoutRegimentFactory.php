<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ScoutRegiment;
use App\Models\ScoutCommission;
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
            'phone' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'scout_commission_id' => ScoutCommission::factory(),
        ];
    }
}
