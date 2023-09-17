<?php

namespace Database\Factories;

use App\Models\ItemDetails;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'unit' => $this->faker->text(255),
            'qtuantity' => $this->faker->randomNumber(),
            'item_id' => \App\Models\Item::factory(),
        ];
    }
}
