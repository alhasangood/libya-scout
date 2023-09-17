<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->name(),
            'qtuantity' => $this->faker->randomNumber(),
            'donation_detales_id' => \App\Models\DonationDetales::factory(),
            'item_id' => \App\Models\Item::factory(),
            'store_house_id' => \App\Models\StoreHouse::factory(),
        ];
    }
}
