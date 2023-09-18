<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DonationDetales;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationDetalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DonationDetales::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'person' => $this->faker->text(255),
            'logo' => $this->faker->word(),
            'number' => $this->faker->randomNumber(),
            'donation_entity_id' => \App\Models\DonationEntity::factory(),
        ];
    }
}
